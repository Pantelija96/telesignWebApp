<?php

namespace App\Http\Controllers;

use App\Exceptions\UserNotEdited;
use App\Http\Requests\UserEditRequest;
use App\Services\UserService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class UserController extends Controller
{
    private $userService;

    public function __construct(UserService $userService){
        $this->userService = $userService;
    }

    public function editProfile(UserEditRequest $request){
        try {
            $attributes = $request->only(['name', 'lastname']);

            $updated = $this->userService->editUser($attributes);

            return redirect()->back()->with('success', 'User edited successfully!');
        } catch (UserNotEdited $e) {
            Log::error('User not edited => '.$e->getMessage());
            return redirect()->back()->with('error', 'User not edited, some error occurred!');
        } catch (\Exception $e) {
            Log::error('User not edited, unexpected error => '.$e->getMessage());
            return redirect()->back()->with('error', 'User not edited, some unexpected error occurred!');
        }
    }
}
