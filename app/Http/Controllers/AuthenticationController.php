<?php

namespace App\Http\Controllers;

use App\Exceptions\LdapBindError;
use App\Exceptions\LdapConnectError;
use App\Exceptions\LdapUserBindError;
use App\Exceptions\LdapUserNotInGroups;
use App\Exceptions\UserNotFound;
use App\Http\Requests\LoginUserRequest;
use App\Http\Resources\UserResource;
use App\Services\UserService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class AuthenticationController extends Controller
{
    protected $userService;

    public function __construct(UserService $userService){
        $this->userService = $userService;
    }

    public function login(LoginUserRequest $request){
        try {
            $user = $this->userService->login($request->validated('email'), $request->validated('password'));
        }
        catch (LdapConnectError $e){
            return redirect()->back()->with('error', $e->getMessage());
        }
        catch (LdapBindError $e){
            return redirect()->back()->with('error', $e->getMessage());
        }
        catch (LdapUserBindError $e){
            return redirect()->back()->with('error', $e->getMessage());
        }
        catch (LdapUserNotInGroups $e){
            return redirect()->back()->with('error', $e->getMessage());
        }
        catch (UserNotFound $e){ 
            return redirect()->back()->with('error', $e->getMessage());
        }
        catch(\Exception $e){
            Log::error('Unexpected error: '.$e->getMessage());
            return redirect()->back()->with('error', "Some unexpected error occurred!");
        }

        Log::info("User: ".$request->validated('email')." successfully logged in @ ".date('m/d/Y H:i:s', time()));
        $request->session()->put('user', $user);

        return redirect('/home/1');
    }

    public function logout(Request $request){
        $request->session()->flush();
        return redirect('/');
    }
}
