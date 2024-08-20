<?php

namespace App\Services;

use App\Exceptions\ROINotCreated;
use App\Exceptions\RoiNotUpdatedRoi;
use App\Models\ROI;

class ROIService
{

    public function addROI($projectId){
        try {
            $roi = new ROI();
            $roi->project_id = $projectId;
            $roi->save();

            return true;
        } catch (\Exception $e) {
            throw new ROINotCreated($e->getMessage());
        }
    }

    public function saveROI($roiData){
        try {
            $roi = ROI::query()->find($roiData["roiId"]);

            $roi->job_date = \Carbon\Carbon::createFromFormat('m/d/Y',$roiData['jobDate'])->format('Y-m-d H:i:s');
            $roi->period_from = \Carbon\Carbon::createFromFormat('m/d/Y',$roiData['periodFrom'])->format('Y-m-d H:i:s');
            $roi->period_to = \Carbon\Carbon::createFromFormat('m/d/Y',$roiData['periodTo'])->format('Y-m-d H:i:s');
            $roi->period_multiplier = intval($roiData['periodMultiplier']);
            $roi->roi = floatval($roiData['roi']);
            $roi->fraud_transactions_avoided = intval($roiData['transactionAvoided']);
            $roi->average_value_of_transaction = floatval($roiData['averageValOfTransaction']);
            $roi->fraud_avoided_by = floatval($roiData['fraudAvoidedBy']);
            $roi->monthly_cost = intval($roiData['monthlyCost']);
            $roi->other_costs_all_numbers = floatval($roiData['otherCostsAllNumbers']);
            $roi->other_costs_fraud_numbers = floatval($roiData['otherCostsFraudNumbers']);
            $roi->total_cost = floatval($roiData['totalCost']);
            $roi->cost_per_phone = floatval($roiData['costPerPhone']);
            $roi->total_per_phone = floatval($roiData['totalPerPhone']);
            $roi->average_sms = floatval($roiData['averageSMS']);
            $roi->total_sms = floatval($roiData['totalSMS']);
            $roi->other_savings = floatval($roiData['otherSavings']);
            $roi->total_savings = floatval($roiData['totalSavings']);

//            return dd($roi);

            $roi->save();
        }
        catch (\Exception $e){
            throw new RoiNotUpdatedRoi($e->getMessage());
        }
    }
}
