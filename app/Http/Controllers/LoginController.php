<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\User;

class LoginController extends Controller
{
    public function subscribe(){

        return view('subscribe');
    }

    public function subscribePost(Request $request){
        $rules = [
            'name' => 'required|max:150|min:3',
            'email' => 'required|email',
            'password' => 'required|alpha_dash|min:8|confirmed'
        ];
        $feedback = [
            'required' => "It's necessary to inform: (:attribute)",
            'name.min' => 'Make sure that your name has at least 3 character',
            'email.email' => 'Please enter your email address',
            'password.confirmed' => 'Make sure that your password machtes the password confirmation',
            'password.min' => 'Make sure that your password has at least 8 character'
        ];
        $request->validate($rules, $feedback);

        $all = $request -> all();
        unset($all['_token']);
        $all['password'] = Hash::make($all['password']);
        User::create($all);

        
        return redirect() -> route('login', ['msgCreatedUser' => 'User created successfully!']);
    }

    public function login(Request $request) {
        if($request->get('failedLogin'))
            return view('login', ['failedLogin' => $request->get('failedLogin')]);

        if($request->get('needAuthentication'))
            return view('login', ['needAuthentication' => $request->get('needAuthentication')]);
        
        if($request->get('msgCreatedUser'))
            return view('login', ['msgCreatedUser' => $request->get('msgCreatedUser')]);  

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
