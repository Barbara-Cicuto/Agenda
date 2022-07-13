<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Contact;

class HomeController extends Controller
{
    public function index(Request $request){
        $user_id = auth()->user()->id;
        $contacts = Contact::where('user_id', $user_id)->get(['id', 'name']);
        if ($request -> get('msgCreatedContact'))
            return view('home', ['msgCreatedContact' => $request -> get('msgCreatedContact'), 'contacts' => $contacts]);
        
        if ($request -> get('msgDeleteContact'))
            return view('home', ['msgDeleteContact' => $request -> get('msgDeleteContact'), 'contacts' => $contacts]);

        if ($request -> get('msgUpdatedContact'))
            return view('home', ['msgUpdatedContact' => $request -> get('msgUpdatedContact'), 'contacts' => $contacts]);  
        
        if ($request -> get('msgUserInfoUpdated'))
            return view('home', ['msgUserInfoUpdated' => $request -> get('msgUserInfoUpdated'), 'user_id' => $user_id, 'contacts' => $contacts]);  
 
        return view('home', ['contacts' => $contacts, 'user_id' => $user_id]);
    }

    public function show($id){
        $contact = Contact::find($id);
        return view('show', ['contact' => $contact]);
    }

    public function newContact(Request $request){
        if($request-> get('emailExists'))
            return view('new-edit', ['emailExists'=> $request->get('emailExists'), 'edit' => false]);
            
        return view('new-edit',['edit' => false]);
    }

    public function newContactPost(Request $request){
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
            'min' => '(:attribute) too short',
        ];
                
        $request->validate($rules,$feedback);
        
        $contact = Contact::where('user_id', auth()->user()->id)->where('email', $request->get('email'))->first();
        if($contact){
            return redirect()->route('new-contact', ["emailExists" => $contact->email." já existe"]);
        }
        
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
        $msgUpdatedContact = 'Contact updated successfully!';

        if ($contact->email == $all['email']) {
            $user_id = auth()->user()->id;
            Contact::where('user_id', $user_id)->where('id', $id)->update($all);
            return redirect()->route('edit-contact', ['id' => $id, 'msgUpdatedContact' => $msgUpdatedContact]);
        } else {
            if (Contact::where('email', $all['email'])->first()) {
                return redirect()->route('edit-contact', ['id' => $id,'msgCantUpdatedContact' => "Contact can't be updated: email already exists!"]);
            } else {
                Contact::where('id', $id)->update($all);
                return redirect()->route('edit-contact', ['id' => $id, 'msgUpdatedContact' => $msgUpdatedContact]);
            }
        } 
    }

    public function delete($id){
        $user_id = auth()->user()->id;
        Contact::where('user_id', $user_id)->where('id', $id)->delete();
        return redirect()->route('home', ['msgDeleteContact' => 'Contact deleted successfully!']);
    }

}
