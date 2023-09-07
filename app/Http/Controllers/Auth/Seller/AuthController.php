<?php

namespace App\Http\Controllers\Auth\Seller;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    
    public function showLoginForm()
    {
        return view('backend.seller.auth.login');
    }

    public function login(Request $request)
    {
        if(Auth::guard('seller')->attempt([
            'email' => $request->email, 
            'password' => $request->password
        ])) {
            return redirect()->intended(route('seller'))->with('success', 'You are logged in successfully');
        }
        else {
            return back()->withInput($request->only('email'));
        }
    }
}
