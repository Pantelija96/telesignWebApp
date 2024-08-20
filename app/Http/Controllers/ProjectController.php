<?php

namespace App\Http\Controllers;

use App\Exceptions\ProjectNotDeleted;
use App\Exceptions\RecordsFileNotValid;
use App\Exceptions\RecordsNotInserted;
use App\Http\Requests\DeleteProjectRequest;
use App\Http\Requests\UploadRecordsRequest;
use App\Models\Record;
use App\Services\ProjectService;
use App\Services\RecordsService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use PhpOffice\PhpSpreadsheet\IOFactory;

class ProjectController extends Controller
{
    protected $recordService;
    protected $projectService;

    public function __construct(RecordsService $recordService, ProjectService $projectService){
        $this->recordService = $recordService;
        $this->projectService = $projectService;
    }

    public function uploadRecords(UploadRecordsRequest $request){
        try{
            $file = $request->file('csvFile');
            $spreadsheet = IOFactory::load($file->getRealPath());
            $worksheet = $spreadsheet->getActiveSheet();
            $recordsData  = $worksheet->toArray();

            $records = [];
            foreach ($recordsData as $oneRecord){
                if (preg_match('/^[+0-9]+$/', $oneRecord[0])) {
                    $records[] = [
                        'project_id' => $request->validated('projectId'),
                        'number' => $oneRecord[0]
                    ];
                }
            }

            $insertedRecords = $this->recordService->insertMultiple($records);

            if($insertedRecords){
                return redirect()->back()->with('success', 'Successfully uploaded records!');
            }
            else{
                return redirect()->back()->with('error', 'Some error happened while inserting into db!');
            }
        }
        catch(RecordsNotInserted $e){
            return redirect()->back()->with('error', $e->getMessage());
        }
        catch (\Exception $e){
            Log::error('Unexpected error: '.$e->getMessage());
            return redirect()->back()->with('error', "Some unexpected error occurred!");
        }
    }

    public function deleteProject(DeleteProjectRequest $request){
        try {
            $projectId = $request->validated('projectId');
            $deleted = $this->projectService->deleteProject($projectId);

            return response()->json([$deleted], 200);
        } catch (ProjectNotDeleted $e) {
            return response()->json(['error' => $e->getMessage()], 400);
        } catch (\Exception $e) {
            return response()->json(['error' => $e->getMessage()], 500);
        }
    }
}
