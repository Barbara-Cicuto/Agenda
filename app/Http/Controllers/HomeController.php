<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Contact;

class HomeController extends Controller
{
    public function index(Request $request){
        $contacts = Contact::all('id', 'name');
        if ($request -> get('msgCreatedContact'))
            return view('home', ['msgCreatedContact' => $request -> get('msgCreatedContact'), 'contacts' => $contacts]);
        return view('home', ['contacts' => $contacts]);
    }

    public function show($id){
        $contact = Contact::find($id);
        return view('show', ['contact' => $contact]);
    }

    public function newEdit(){
        return view('new-edit');
    }

    public function newEditPost(Request $request){
        $rules = [
            'name' => 'required|max:150|min:3',
            'phone' => 'required|max:18|min:14',
            'email' => 'required|max:255|unique:contacts|email',
            'age' => 'required|max:3|min:1',
            'instagram' => 'max:150|min:5',
            'linkedin' => 'max:150|min:5',
            'github' => 'max:150|min:5'
        ];
        $feedback = [
            'required' => 'You must fill in the (:attribute)',
            'max' => '(:attribute) too long',
            'min' => '(:attribute) too short',
            'email.unique' => 'This email already exist in the database',
        ];

        $request->validate($rules,$feedback);

        $all = $request -> all();
        unset($all['_token']);
        Contact::create($all);

        return redirect() -> route('home', ['msgCreatedContact' => 'Contact created successfully!']);
    }
}
