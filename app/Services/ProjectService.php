<?php

namespace App\Services;

use App\DataTransferObjects\ProjectDto;
use App\Exceptions\ProjectNotDeleted;
use App\Exceptions\ProjectNotUpdatedRoi;
use App\Models\Project;

class ProjectService
{

    public function createBlankProject(){
        $project = Project::create(['id_user' => session()->get('user')->id]);
        return $project->id;
    }

    public function getOneProject($id){
        $project = Project::query()
            ->where('id','=', $id)
            ->with('user')
            ->first();

        return new ProjectDto($project->toArray());
    }

    public function getProjectWithRecords($id){
        $project = Project::query()
            ->where('id','=', $id)
            ->with('user')
            ->with('records')
            ->first();

        return new ProjectDto($project->toArray());
    }

    public function getProjectWithRoi($id){
        $project = Project::query()
            ->where('id', '=', $id)
            ->with('user')
            ->with('roi')
            ->withCount('records')
            ->first();

        return new ProjectDto($project->toArray());
    }

    public function updateData($id, $projectData){
        $project = Project::query()->find($id);

        $project->allow = $projectData['allow'];
        $project->flag = $projectData['flag'];
        $project->block = $projectData['block'];
        $project->very_low = $projectData['very_low'];
        $project->low = $projectData['low'];
        $project->medium_low = $projectData['medium_low'];
        $project->medium = $projectData['medium'];
        $project->high = $projectData['high'];
        $project->very_high = $projectData['very_high'];
        $project->scored = true;

        $project->countries = json_encode($projectData['countries']);

        $project->save();

        return $project;
    }

    public function deleteProject($id){
        try{
            $deleted = Project::query()->find($id)->delete();

            if (!$deleted) {
                throw new ProjectNotDeleted('Record could not be deleted!');
            }

            return $deleted;
        }
        catch (\Exception $e){
            throw new ProjectNotDeleted($e->getMessage());
        }
    }

    public function projectSaved($roiData){
        try {
            $project = Project::query()->find($roiData["projectId"]);
            $project->saved = true;
            $project->name = $roiData["customerName"];
            $project->description = $roiData["solutionDescription"];
            $project->high_positive_rate = intval($roiData["highPositiveRateHidden"]);
            $project->very_high_positive_rate = intval($roiData["veryHighPositiveRateHidden"]);
            $project->save();
        }
        catch (\Exception $e){
            throw new ProjectNotUpdatedRoi($e->getMessage());
        }
    }

    public function getReadOnlyProject($id){
        $project = Project::query()
            ->where('id', '=', $id)
            ->with('user')
            ->with('roi')
            ->with('records')
            ->first();

        return new ProjectDto($project->toArray());
    }
}
