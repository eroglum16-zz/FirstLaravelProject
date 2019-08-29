<?php

namespace App\Http\Controllers\ApiAuth;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;

class LoginController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles authenticating users for the application and
    | redirecting them to your home screen. The controller uses a trait
    | to conveniently provide its functionality to your applications.
    |
    */

    use AuthenticatesUsers;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }

    /**
     * Log the user in.
     *
     * @return userdata|403
     */
    public function login(Request $request){

        $this->validateLogin($request);

        if ($this->attemptLogin($request)) {
            auth()->user()->generateToken();
            $data['user']=auth()->user();
            return $data;
        }

        return ['Success'=>false, 'Code'=>403];
    }

    public function logout(Request $request)
    {
        $user = auth()->user();

        if ($user) {
            $user->forgetToken();
            return response()->json(['message' => 'User logged out.'], 200);
        }

        return response()->json(['message' => 'User not found.'], 404);

    }
}
