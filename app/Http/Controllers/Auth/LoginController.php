<?php

namespace App\Http\Controllers\Auth;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Support\Facades\Log;

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
     * Where to redirect users after login.
     *
     * @var string
     */
    protected $redirectTo = RouteServiceProvider::HOME;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }

    // public function credentials(Request $request) 
    // {
    //     $email = $request->email;
    //     $password = $request->password;
    //     $status = $request->status;
    //     $role = $request->admin;
        
    //     // Log the values for debugging
    //     Log::info("Email: $email, Password: $password, Status: $status, Role: $role");
        
    //     return [
    //         'email' => $email,
    //         'password' => $password,
    //         'status' => $status,
    //         'role' => $role
    //     ];
    // }
}
