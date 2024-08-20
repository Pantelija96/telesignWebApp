<?php

namespace App\DataTransferObjects;

class RecordDto
{
    public $id;
    public $number;
    public $ip;
    public $email;
    public $score;
    public $type;
    public $carrier_name;
    public $risk_level;
    public $recommendation;
    public $status;
    public $category;
    public $a2p;
    public $p2p;
    public $number_type;
    public $ip_insight;
    public $email_insight;
    public $created_at;
    public $updated_at;
    public $country_id ;
    public $project_id ;



    public function __construct(array $record){
        $this->id = $record['id'];
        $this->number = $record['number'];
        $this->ip = $record['ip'];
        $this->email = $record['email'];
    }
}
