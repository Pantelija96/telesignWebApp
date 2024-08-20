<?php

namespace App\Http\Controllers;

use App\Exceptions\ProjectNotUpdatedRoi;
use App\Exceptions\RoiNotUpdatedRoi;
use App\Http\Requests\ROIRequest;
use App\Services\ProjectService;
use App\Services\ROIService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class ROIController extends Controller
{
    private $roiService;
    private $projectService;

    public function __construct(ROIService $roiService, ProjectService $projectService){
        $this->roiService = $roiService;
        $this->projectService = $projectService;
    }

    public function saveRoi(ROIRequest $request){
//        return dd($request);
        try {
            $this->projectService->projectSaved($request->only([
                'projectId',
                'highPositiveRateHidden',
                'veryHighPositiveRateHidden',
                'solutionDescription',
                'customerName'
            ]));
            $this->roiService->saveROI($request->all());
        }
        catch (ProjectNotUpdatedRoi $e){
            Log::error('Error while saving roi in project => '.$e->getMessage());
            return redirect()->back()->with('error', "Error while saving ROI in project!");
        }
        catch (RoiNotUpdatedRoi $e){
            Log::error('Error while saving roi in roi => '.$e->getMessage());
            return redirect()->back()->with('error', "Error while saving ROI in ROI!");
        }
        catch (\Exception $e){
            Log::error('Unexpected error occurred => '.$e->getMessage());
            return redirect()->back()->with('error', "Unexpected error occurred while saving ROI!");
        }

        return redirect('/home/1')->with('success','Successfully calculated ROI for: ' . $request->get('customerName'));
    }
}
