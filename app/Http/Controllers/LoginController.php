<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\User;

class LoginController extends Controller
{
    public function login(Request $request) {
        if($request->get('failedLogin'))
            return view('login', ['failedLogin' => $request->get('failedLogin')]);

        if($request->get('needAuthentication'))
            return view('login', ['needAuthentication' => $request->get('needAuthentication')]);
        
        return view('login');
    }

    public function loginPost(Request $request) {
        $rules = [
            'email'=>'required|email',
            'password'=>'required'
        ];
        $feedback = [
            'required' => "It's necessary to inform: (:attribute)",
            'email.email' => 'Please enter your email address'
        ];
        $request->validate($rules, $feedback);

        $credentials = $request->only('email', 'password');
        $remember = $request->only('rememberMe');

        if(Auth::attempt($credentials, $remember)){
            return redirect()->route('home');
        }
        

        return redirect()->route('login', ['failedLogin'=>'User not found']);

    }

    public function logout() {
        Auth::logout();
        return redirect()->route('login');
    }
}
