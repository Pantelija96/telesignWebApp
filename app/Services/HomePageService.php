<?php

namespace App\Services;

use App\DataTransferObjects\HomePageProjectDto;
use App\Models\Project;

class HomePageService
{
    public function getReadOnlyProjects($page, $byPage){
        $projectsQuery = Project::query()
            ->where('id_user','!=', session()->get('user')->id)
            ->orderByDesc('created_at')
            ->get();
        $projectsDto = HomePageProjectDto::collection($projectsQuery);

        return ($projectsQuery);
    }

    public function getOwnedProjects($page, $byPage){
        $projectsQuery = Project::query()
            ->where('id_user','=', session()->get('user')->id)
            ->orderByDesc('created_at')
            ->get();
        $projectsDto = HomePageProjectDto::collection($projectsQuery);

        return ($projectsDto);
    }

    public function getAllUnsavedProjects(){
        $projects = Project::query()
            ->where('id_user','=', session()->get('user')->id)
            ->where('saved', '=', false)
            ->orderByDesc('created_at')
            ->get();

        return HomePageProjectDto::collection($projects);
    }

    public function getAllProjects(){
        $projectsQuery = Project::query()
            ->orderByDesc('created_at')
            ->get();
        $projectsDto = HomePageProjectDto::collection($projectsQuery);

        return ($projectsDto);
    }
}
