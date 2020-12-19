<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Contact;
use Brian2694\Toastr\Facades\Toastr;
class ContactController extends Controller
{
	public function contact(Request $request)
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
    	Toastr::success('Message sent successfully!', 'Success', ["positionClass" => "toast-top-right"]);
    	return redirect()->back();
	}
    public function index(){
    	$contacts = Contact::all();
    	return view('admin.contact.index', compact('contacts'));
    }
    public function show($id){
    	$contact = Contact::find($id);
    	return view('admin.contact.show', compact('contact'));
    }
    public function destroy($id){
    	$contact = Contact::find($id);
    	$contact->delete();
    	return redirect()->route('contact.index')->with('danger', 'Message deleted successfully');
    }
}
