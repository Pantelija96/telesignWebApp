<?php

namespace App\Http\Controllers;

use App\Exceptions\RecordNotAdded;
use App\Exceptions\RecordNotDeleted;
use App\Exceptions\RecordNotEdited;
use App\Exceptions\RecordNotFound;
use App\Http\Requests\AddRecordRequest;
use App\Http\Requests\DeleteRecordRequest;
use App\Http\Requests\EditRecordRequest;
use App\Http\Requests\ScoreRecordsRequest;
use App\Services\ProjectService;
use App\Services\RecordsService;
use Illuminate\Http\Request;

class RecordController extends Controller
{
    protected $recordService;
    protected $projectService;

    public function __construct(RecordsService $recordService, ProjectService $projectService){
        $this->recordService = $recordService;
        $this->projectService = $projectService;
    }

    public function addRecord(AddRecordRequest $request){
        try {
            $projectId = $request->validated('projectId');
            $attributes = $request->only(['number', 'email', 'ip']);

            $added = $this->recordService->addRecord($projectId, $attributes);

            return response()->json([$added], 200);
        } catch (RecordNotAdded $e) {
            return response()->json(['error' => $e->getMessage()], 400);
        } catch (\Exception $e) {
            return response()->json(['error' => $e->getMessage()], 500);
        }
    }
    public function editRecord(EditRecordRequest $request){
        try {
            $recordId = $request->validated('recordId');
            $attributes = $request->only(['number', 'email', 'ip']);

            $updated = $this->recordService->editRecord($recordId, $attributes);

            return response()->json([$updated], 200);
        } catch (RecordNotEdited $e) {
            return response()->json(['error' => $e->getMessage()], 400);
        } catch (\Exception $e) {
            return response()->json(['error' => $e->getMessage()], 500);
        }
    }
    public function deleteRecord(DeleteRecordRequest $request){
        try {
            $recordId = $request->validated('recordId');
            $deleted = $this->recordService->deleteRecord($recordId);

            return response()->json([$deleted], 200);
        } catch (RecordNotDeleted $e) {
            return response()->json(['error' => $e->getMessage()], 400);
        } catch (\Exception $e) {
            return response()->json(['error' => $e->getMessage()], 500);
        }
    }

    public function scoreRecords(ScoreRecordsRequest $request){
        $projectId = $request->validated('projectId');
        $projectData = $this->recordService->scoreRecords($projectId);
        $projectUpdated = $this->projectService->updateData($projectId, $projectData);
        return redirect()->back();
    }

    public function getOneRecord(Request $request){
        try {
            $recordId = $request->get('recordId');
            $oneRecord = $this->recordService->getOneRecord($recordId);

            return response()->json([$oneRecord], 200);
        } catch (RecordNotFound $e) {
            return response()->json(['error' => $e->getMessage()], 400);
        } catch (\Exception $e) {
            return response()->json(['error' => $e->getMessage()], 500);
        }
    }
}
