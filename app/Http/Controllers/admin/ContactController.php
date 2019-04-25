<?php

namespace App\Http\Controllers\admin;

use App\Contact;
use Yoeunes\Toastr\Toastr;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class ContactController extends Controller
{
	public function index()
	{
		$contacts = Contact::all();
    	return view('admin.contact.index',compact('contacts'));
	}

	public function show($id)
	{
		$contact = Contact::find($id);
		return view('admin.contact.show',compact('contact'));
	}

	public function delete($id)
	{
		Contact::find($id)->delete();
		toastr()->success('Contact Message successfully deleted.','Success',['positionClass'=>'toast-top-right']);
		return redirect()->back();
	}
}
