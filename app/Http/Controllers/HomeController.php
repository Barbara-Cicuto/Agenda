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
        
        if ($request -> get('msgDeleteContact'))
            return view('home', ['msgDeleteContact' => $request -> get('msgDeleteContact'), 'contacts' => $contacts]);

        if ($request -> get('msgUpdatedContact'))
            return view('home', ['msgUpdatedContact' => $request -> get('msgUpdatedContact'), 'contacts' => $contacts]);   
 
        return view('home', ['contacts' => $contacts]);
    }

    public function show($id){
        $contact = Contact::find($id);
        return view('show', ['contact' => $contact]);
    }

    public function newContact(){
        return view('new-edit',['edit' => false]);
    }

    public function newContactPost(Request $request){
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
    
    public function editContact (Request $request, $id) {
        $contact = Contact::find($id);
        
        if ($request -> get('msgUpdatedContact'))
            return view('new-edit', ['msgUpdatedContact' => $request -> get('msgUpdatedContact'), 'contact' => $contact,'edit' => true]); 

        if ($request -> get('msgCantUpdatedContact'))
            return view('new-edit', ['msgCantUpdatedContact' => $request -> get('msgCantUpdatedContact'), 'contact' => $contact,'edit' => true]); 

        return view('new-edit', ['contact' => $contact, 'edit' => true]);
    }
    
    public function editContactPost (Request $request, $id) {
        $rules = [
            'name' => 'required|max:150|min:3',
            'phone' => 'required|max:18|min:14',
            'email' => 'required|max:255|email',
            'age' => 'required|max:3|min:1',
            'instagram' => 'max:150|min:5',
            'linkedin' => 'max:150|min:5',
            'github' => 'max:150|min:5'
        ];
        $feedback = [
            'required' => 'You must fill in the (:attribute)',
            'max' => '(:attribute) too long',
            'min' => '(:attribute) too short'
        ];

        $request->validate($rules, $feedback);

        $all = $request -> all();
        unset($all['_token']);

        $contact = Contact::where('id', $id)->first('email');

        if ($contact->email == $all['email']) {
            Contact::where('id', $id)->update($all);
            return redirect()->route('edit-contact', ['id' => $id, 'msgUpdatedContact' => 'Contact updated successfully!']);
        } else {
            if (Contact::where('email', $all['email'])->first()) {
                return redirect()->route('edit-contact', ['id' => $id,'msgCantUpdatedContact' => "Contact can't be updated: email already exists!"]);
            } else {
                Contact::where('id', $id)->update($all);
                return redirect()->route('edit-contact', ['id' => $id, 'msgUpdatedContact' => 'Contact updated successfully!']);
            }
        } 
    }

    public function delete($id){
        Contact::where('id', $id)->delete();
        return redirect() -> route('home', ['msgDeleteContact' => 'Contact deleted successfully!']);
    }
}
