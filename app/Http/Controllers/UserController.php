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

    public function profile(Request $request, $id){
        $user_info = User::where('id', $id)->get(['name','email'])->first();

        if ($request -> get('msgUserEmailExists'))
            return view('user', ['id' => $id, 'user' => $user_info, 'msgUserEmailExists' => $request -> get('msgUserEmailExists')]);
        
        return view ('user', ['user' => $user_info, 'id' => $id]);
    }


    public function profilePost(Request $request, $id) {
        $rules = [
            'name' => 'required|max:150|min:3',
            'email' => 'required|email'
        ];
        $feedback = [
            'required' => "It's necessary to inform: (:attribute)",
            'max' => 'Make sure that your name is up to 150 character',
            'min' => 'Make sure that your name has at least 3 character',
            'email' => 'Please enter your email address'
        ];

        $request->validate($rules, $feedback);

        $all = $request->all();
        unset($all['_token']);

        $user = User::where('id', $id)->first('email');   
        $msgUserInfoUpdated = "User information updated successfully.";
        
        if ($user->email == $all['email']) {
            User::where('id', $id)->update($all);
            return redirect()->route('home', ['id' => $id, 'msgUserInfoUpdated' => $msgUserInfoUpdated]);
        } else {
            if (User::where('email', $all['email'])->first()) {
                return redirect()->route('profile', ['id' => $id, 'msgUserEmailExists' => "User information can't be updated because the email address is already in use by another user."]);
            } else {
                User::where('id', $id)->update($all);
                return redirect()->route('home', ['id' => $id, 'msgUserInfoUpdated' => $msgUserInfoUpdated]);
            }
        }
    }

    public function delete($id) {
        User::where('id', $id)->delete();
        return redirect()->route('login');
    }
}