<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Reservation;

class MessagesController extends Controller
{
    public function index(){
    	$messages = Reservation::all();
    	return view('admin.messages.index', compact('messages'));
    }
    public function destroy($id)
    {
    	$message = Reservation::find($id);
    	$message->delete();
    	return redirect()->route('messages.index')->with('danger', 'Message deleted successfully!');
    }
}
