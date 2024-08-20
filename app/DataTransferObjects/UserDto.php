<?php

namespace App\DataTransferObjects;

use App\Models\User;

class UserDto
{
    public $id;
    public $name;
    public $last_name;
    public $email;
    public $password;
    public $unsaved_projects;


    public function __construct(array $user){
        $this->id = $user['id'];
        $this->name = $user['name'];
        $this->last_name = $user['last_name'];
        $this->email = $user['email'];
        $this->password = isset($user['password']) ? $user['password'] : null;
        $this->unsaved_projects = isset($user['unsaved_projects_count']) ? $user['unsaved_projects_count'] : null;
    }
}
