<?php

namespace App\DataTransferObjects;

class HomePageProjectDto
{
    public $id;
    public $name;
    public $description;
    public $saved;
    public $created_at;
    public $owner;
    public $scored;

    public $currentPage;
    public $totalPages;
    public $totalCount;

    public function __construct(array $project){
        $this->id = $project['id'];
        $this->name = $project['name'];
        $this->description = $project['description'];
        $this->saved = $project['saved'];
        $this->created_at = $project['created_at'];
        $this->owner = $project['id_user'];
        $this->scored = $project['scored'];
    }

    public static function collection($projects){
        return $projects->map(function ($project){
            return new HomePageProjectDto($project->toArray());
        });
    }
}
