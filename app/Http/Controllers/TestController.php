<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class TestController extends Controller
{
    public function test(){
        $user = User::with('unsavedProjects')->get();
        return dd($user);
    }
}
