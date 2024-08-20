<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Country extends Model
{

    public function records(){
        return $this->hasMany(Record::class);
    }

    public function projects(){
        return $this->belongsToMany(Project::class,'country_project','id_project','id_country');
    }
}
