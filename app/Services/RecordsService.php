<?php

namespace App\Services;

use App\DataTransferObjects\ProjectDto;
use App\Exceptions\RecordNotAdded;
use App\Exceptions\RecordNotDeleted;
use App\Exceptions\RecordNotEdited;
use App\Exceptions\RecordNotFound;
use App\Exceptions\RecordsNotInserted;
use App\Models\Project;
use App\Models\Record;

use GuzzleHttp\Client;
use GuzzleHttp\Promise;
use GuzzleHttp\Promise\Utils;
use Illuminate\Support\Facades\Log;


class RecordsService
{

    private $projectApiResult = [
        'allow' => 0,
        'flag' => 0,
        'block' => 0,
        'very_low' => 0,
        'low' => 0,
        'medium_low' => 0,
        'medium' => 0,
        'high' => 0,
        'very_high' => 0,
        'number_of_records' => 0,
        'total_score' => 0,
        'countries' => []
    ];


    public function getAll($projectId){
        return Record::query()->get();
    }

    public function insertMultiple($records){
        $inserted = Record::insert($records);

        if(!$inserted){
            throw new RecordsNotInserted();
        }

        return $inserted;
    }
    public function addRecord($projectId, array $attributes)
    {
        try {
            $record = new Record();
            $record->project_id = $projectId;
            $record->fill($attributes)->save();

            return $record;
        } catch (\Exception $e) {
            throw new RecordNotAdded($e->getMessage());
        }
    }
    public function editRecord($recordId, array $attributes)
    {
        try {
            $record = Record::query()->findOrFail($recordId);
            $updated = $record->fill($attributes)->save();

            if (!$updated) {
                throw new RecordNotEdited('Record could not be updated!');
            }

            return $record;
        } catch (\Exception $e) {
            throw new RecordNotEdited($e->getMessage());
        }
    }
    public function deleteRecord($recordId){
        try {
            $deleted = Record::query()->find($recordId)->delete();

            if (!$deleted) {
                throw new RecordNotDeleted('Record could not be deleted!');
            }

            return $deleted;
        } catch (\Exception $e) {
            throw new RecordNotDeleted($e->getMessage());
        }
    }

    public function getOneRecord($recordId){
        try {
            $record = Record::query()->findOrFail($recordId);

            if (!$record) {
                throw new RecordNotFound('Record not found!');
            }

            return $record;
        } catch (\Exception $e) {
            throw new RecordNotFound($e->getMessage());
        }
    }


    public function scoreRecords($projectId)
    {
        set_time_limit(0);
        $records = Record::query()
            ->where('project_id', '=', $projectId)
            ->get();

        $client = new Client();
        $promises = [];
        $concurrency = 50;
        $authKey = config('services.telesign_api_key');

        $requestHandler = function ($record) use ($authKey, $client) {
            return $client->postAsync('https://rest-ww.telesign.com/v1/score/' . $record->number, [
                'headers' => [
                    'Accept' => '*/*',
                    'Authorization' => $authKey,
                    'Content-Type' => 'application/x-www-form-urlencoded'
                ],
                'form_params' => [
                    'account_lifecycle_event' => 'create',
                    'request_risk_insights' => 'true',
                    'originating_ip' => $record->ip == null ? '' : $record->ip,
                    'email_address' => $record->email == null ? '' : $record->email,
                ]
            ])->then(
                function ($response) use ($record) {
                    $scoredData = json_decode($response->getBody()->getContents(), true);
                    $record->score = isset($scoredData['risk']['score']) ? $scoredData['risk']['score'] : null;
                    $record->type = isset($scoredData['phone_type']['description']) ? $scoredData['phone_type']['description'] : null;
                    $record->carrier_name = isset($scoredData['carrier']['name']) ? $scoredData['carrier']['name'] : null;
                    $record->risk_level = isset($scoredData['risk']['level']) ? $scoredData['risk']['level'] : null;
                    $record->recommendation = isset($scoredData['risk']['recommendation']) ? $scoredData['risk']['recommendation'] : null;
                    $record->country_iso = isset($scoredData['location']['country']['iso2']) ? $scoredData['location']['country']['iso2'] : null;
                    $record->country_iso3 = isset($scoredData['location']['country']['iso3']) ? $scoredData['location']['country']['iso3'] : null;
                    $record->country_name = isset($scoredData['location']['country']['name']) ? $scoredData['location']['country']['name'] : null;
                    $record->status = isset($scoredData['risk_insights']['status']) ? $scoredData['risk_insights']['status'] : null;
                    $record->category = json_encode(isset($scoredData['risk_insights']['category']) ? $scoredData['risk_insights']['category'] : []);
                    $record->a2p = json_encode(isset($scoredData['risk_insights']['a2p']) ? $scoredData['risk_insights']['a2p'] : []);
                    $record->p2p = json_encode(isset($scoredData['risk_insights']['p2p']) ? $scoredData['risk_insights']['p2p'] : []);
                    $record->number_type = json_encode(isset($scoredData['risk_insights']['number_type']) ? $scoredData['risk_insights']['number_type'] : []);
                    $record->ip_insight = json_encode(isset($scoredData['risk_insights']['ip']) ? $scoredData['risk_insights']['ip'] : []);
                    $record->email_insight = json_encode(isset($scoredData['risk_insights']['email']) ? $scoredData['risk_insights']['email'] : []);
                    $record->save();

                    return $scoredData;
                },
                function ($exception) {
                    // Log or handle the exception
                    error_log($exception->getMessage());
                    return null;
                }
            );
        };

        foreach ($records->chunk($concurrency) as $chunk) {
            foreach ($chunk as $record) {
                $promises[] = $requestHandler($record);
            }
            $results = Utils::settle($promises)->wait();
            foreach ($results as $result) {
                if(isset($result['value'])){
                    $this->transformApiResponse($result['value']);
                }
            }
            $promises = [];
        }

        return $this->projectApiResult;
    }
    private function transformApiResponse($result){

        $countryName = $result['location']['country']['name'];
        $countryIso = $result['location']['country']['iso2'];
        $countryIso3 = $result['location']['country']['iso3'];
        $riskLevel = str_replace('-', '_', $result['risk']['level']);
        $riskRecommendation = $result['risk']['recommendation'];
        $phoneType = $result['phone_type']['description'];

        // Find or create country entry
        $countryIndex = $this->getCountryIndex($countryName, $countryIso, $countryIso3, $phoneType);

        // Update country & project entry
        $this->projectApiResult['countries'][$countryIndex]['number_of_records']++;
        $this->projectApiResult['number_of_records']++;

        $this->projectApiResult['countries'][$countryIndex]['total_score'] += $result['risk']['score'];
        $this->projectApiResult['total_score'] += $result['risk']['score'];

        $riskLevelIndex = $this->getRiskLevelIndex($riskLevel);
        if ($riskLevelIndex !== false) {
            $this->projectApiResult['countries'][$countryIndex][$riskLevel]++;
            $this->projectApiResult[$riskLevel]++;
        }

        if ($riskRecommendation == 'allow') {
            $this->projectApiResult['countries'][$countryIndex]['allow']++;
            $this->projectApiResult['allow']++;
        } elseif ($riskRecommendation == 'flag') {
            $this->projectApiResult['countries'][$countryIndex]['flag']++;
            $this->projectApiResult['flag']++;
        } elseif ($riskRecommendation == 'block') {
            $this->projectApiResult['countries'][$countryIndex]['block']++;
            $this->projectApiResult['block']++;
        }

        // Update phone type entry
        $typeIndex = null;
        foreach ($this->projectApiResult['countries'][$countryIndex]['types'] as $index => $type) {
            if ($type['type'] == $phoneType) {
                $typeIndex = $index;
                break;
            }
        }

        if ($typeIndex === null) {
            $typeIndex = count($this->projectApiResult['countries'][$countryIndex]['types']);
            $this->projectApiResult['countries'][$countryIndex]['types'][] = [
                "type" => $phoneType,
                "allow" => 0,
                "flag" => 0,
                "block" => 0
            ];
        }

        if ($riskRecommendation == 'allow') {
            $this->projectApiResult['countries'][$countryIndex]['types'][$typeIndex]['allow']++;
        } elseif ($riskRecommendation == 'flag') {
            $this->projectApiResult['countries'][$countryIndex]['types'][$typeIndex]['flag']++;
        } elseif ($riskRecommendation == 'block') {
            $this->projectApiResult['countries'][$countryIndex]['types'][$typeIndex]['block']++;
        }
    }
    private function getRiskLevelIndex($level)
    {
        $levels = ['very_low', 'low', 'medium_low', 'high', 'very_high'];
        return array_search($level, $levels);
    }
    private function getCountryIndex($countryName, $countryIso, $countryIso3, $phoneType){
        $countryIndex = null;
        foreach ($this->projectApiResult['countries'] as $index => $entry) {
            if ($entry['country_name'] == $countryName) {
                $countryIndex = $index;
                break;
            }
        }

        if ($countryIndex === null) {
            $countryIndex = count($this->projectApiResult['countries']);
            $this->projectApiResult['countries'][] = [
                "country_name" => $countryName,
                "country_iso" => $countryIso,
                "country_iso3" => $countryIso3,
                "allow" => 0,
                "flag" => 0,
                "block" => 0,
                "total_score" => 0,
                "number_of_records" => 0,
                "very_low" => 0,
                "low" => 0,
                "medium_low" => 0,
                "high" => 0,
                "very_high" => 0,
                "types" => [
                    [
                        "type" => $phoneType,
                        "allow" => 0,
                        "flag" => 0,
                        "block" => 0
                    ]
                ]
            ];
        }

        return $countryIndex;
    }

}
