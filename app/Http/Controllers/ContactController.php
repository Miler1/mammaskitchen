<?php

namespace App\Http\Controllers;

use App\Contact;
use Yoeunes\Toastr\Toastr;
use Illuminate\Http\Request;

class ContactController extends Controller
{
    public function sendMessage(Request $request)
    {
    	$this->validate($request,[
    		'name' => 'required',
    		'email' => 'required',
    		'subject' => 'required',
    		'message' => 'required',
    	]);

    	$contact = new Contact();
    	$contact->name = $request->name;
    	$contact->email = $request->email;
    	$contact->subject = $request->subject;
    	$contact->message = $request->message;
    	$contact->save();
    	toastr()->success('Your message successfully send.','Success',['positionClass'=>'toast-top-right']);
    	return redirect()->back();
    }
}
