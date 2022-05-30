<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index(){
        return view('home');
    }

    public function show(){
        return view('show');
    }

    public function newEdit(){
        return view('new-edit');
    }

    public function newEditPost(Request $request){
        dd('oi');
    }
}
