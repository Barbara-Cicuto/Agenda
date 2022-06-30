<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\User;

class UserController extends Controller
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
}
