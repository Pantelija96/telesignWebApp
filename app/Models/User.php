<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class User extends Model
{
    protected $guarded = ['email'];

    public function projects(){
        return $this->hasMany(Project::class,'id_user');
    }

    public function unsavedProjects(){
        return $this->hasMany(Project::class, 'id_user')->where('saved','=', false);
    }
}
