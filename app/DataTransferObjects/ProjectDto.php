<?php

namespace App\DataTransferObjects;

use App\Models\ROI;
use App\Services\UserService;

class ProjectDto
{
    public $id;
    public $name;
    public $description;
    public $saved;
    public $allow;
    public $flag;
    public $block;
    public $very_low;
    public $low;
    public $medium_low;
    public $medium;
    public $high;
    public $very_high;
    public $created_at;
    public $user;
    public $records;
    public $scored;
    public $high_positive_rate;
    public $very_high_positive_rate;
    public $countries;
    public $roi;
    public $records_count;

    public function __construct(array $project){
        $this->id = $project['id'];
        $this->name = $project['name'];
        $this->description = $project['description'];
        $this->saved = $project['saved'];
        $this->allow = $project['allow'];
        $this->flag = $project['flag'];
        $this->block = $project['block'];
        $this->very_low = $project['very_low'];
        $this->low = $project['low'];
        $this->medium_low = $project['medium_low'];
        $this->medium = $project['medium'];
        $this->high = $project['high'];
        $this->very_high = $project['very_high'];
        $this->created_at = $project['created_at'];
        $this->scored = $project['scored'];
        $this->high_positive_rate = $project['high_positive_rate'];
        $this->very_high_positive_rate = $project['very_high_positive_rate'];
        $this->user = isset($project['user']) ? new UserDto($project['user']) : null;
        $this->records = isset($project['records']) ? $this->collection($project['records']) : null;
        $this->countries = isset($project['countries']) ? json_decode($project['countries']) : null;
        $this->roi = isset($project['roi']) ? new ROI($project['roi']) : null;
        $this->records_count = isset($project['records_count']) ? $project['records_count'] : null;
    }

    public function collection($records){
        return collect($records)->map(function ($record) {
            return new RecordDto($record);
        });
    }
}
