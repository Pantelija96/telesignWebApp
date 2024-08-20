<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Project extends Model
{
    protected $fillable = ['id_user'];

    public function records(){
        return $this->hasMany(Record::class);
    }

    public function roi(){
        return $this->hasOne(ROI::class);
    }

    public function user(){
        return $this->belongsTo(User::class, 'id_user');
    }

    public function countries(){
        return $this->belongsToMany(Country::class,'country_project','id_country','id_project');
    }
}
