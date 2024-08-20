<?php

namespace App\Http\Controllers;

use App\Exceptions\ROINotCreated;
use App\Services\HomePageService;
use App\Services\ProjectService;
use App\Services\ROIService;
use App\Services\UserService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class FrontendController extends Controller
{
    private $homePageService = null;
    private $projectService = null;
    private $roiService = null;
    private $userService = null;
    private $data = [];

    public function __construct(HomePageService $homePageService, ProjectService $projectService, ROIService $roiService, UserService $userService){
        $this->homePageService = $homePageService;
        $this->projectService = $projectService;
        $this->roiService = $roiService;
        $this->userService = $userService;
    }

    public function index(){
        return view('pages.login', $this->data);
    }

    public function home($view = 1){
        $this->data['view'] = (int) $view;
        if($view == 1){
            $this->data['readOnlyProjects'] = $this->homePageService->getReadOnlyProjects(1,20);
            $this->data['ownedProjects'] = $this->homePageService->getOwnedProjects(1,20);
        }
        else{
            $this->data['allProjects'] = $this->homePageService->getAllProjects();
        }
        return view('pages.home', $this->data);
    }

    public function unsaved($view = 1){
        $this->data['view'] = (int) $view;
        $this->data['allProjects'] = $this->homePageService->getAllUnsavedProjects();
        return view('pages.unsaved', $this->data);
    }

    public function newProject($id = null){
        if($id == null){
            try {
                $newProjectId = $this->projectService->createBlankProject();
                $newRoi = $this->roiService->addROI($newProjectId);
            }
            catch (ROINotCreated $e){
                $this->projectService->deleteProject($newProjectId);
                Log::error('Error while creating ROI '.$e->getMessage());
                return redirect()->back()->with('error', "ROI creation error!");
            }
            catch (\Exception $e){
                $this->projectService->deleteProject($newProjectId);
                Log::error('Unexpected error '.$e->getMessage());
                return redirect()->back()->with('error', "Unexpected error occurred!");
            }

            if($newRoi){
                return redirect('/newProject/' . $newProjectId);
            }
            else{
                $this->projectService->deleteProject($newProjectId);
                Log::error('Unexpected error -> ROI creating = FALSE!');
                return redirect()->back()->with('error', "Unexpected error occurred!");
            }
        }
        else{
            $this->data['project'] = $this->projectService->getProjectWithRecords($id);
            return view('pages.newProject', $this->data);
        }
    }

    public function editProject($id){
        $this->data['project'] = $this->projectService->getProjectWithRecords($id);
        return view('pages.editProject', $this->data);
    }

    public function readOnlyProject($id){
        $this->data['project'] = $this->projectService->getReadOnlyProject($id);
//        return dd($this->data);
        return view('pages.seeProject', $this->data);
    }

    public function showRoi($id){
        $this->data['project'] = $this->projectService->getProjectWithRoi($id);
//        return dd($this->data['project']);
        return view('pages.roi', $this->data);
    }

    public function readOnlyRoi($id){
        $this->data['project'] = $this->projectService->getProjectWithRoi($id);
//        return dd($this->data);
        return view('pages.readOnlyRoi', $this->data);
    }

    public function profile(){
        $this->data['user'] = $this->userService->getUserId(session()->get('user')->id);
        return view('pages.editProfile', $this->data);
    }
}
