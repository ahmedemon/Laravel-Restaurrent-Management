<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Reservation;
use Brian2694\Toastr\Facades\Toastr;
class ReservationController extends Controller
{
    public function reserve(Request $request){
    	$this->validate($request, [
	    		'name' => 'required',
	    		'email' => 'required',
	    		'phone' => 'required',
	    		'date_and_time' => 'required',
	    		'message' => 'required',
	    	],
	    	[
	    		'name.required' => 'Field is required!',
	    		'email.required' => 'Field is required!',
	    		'phone.required' => 'Field is required!',
	    		'date_and_time.required' => 'Field is required!',
	    		'message.required' => 'Field is required!',
	    	]
    	);

    	$reservation = new Reservation();
    	$reservation->name = $request->name;
    	$reservation->email = $request->email;
    	$reservation->phone = $request->phone;
    	$reservation->date_and_time = $request->date_and_time;
    	$reservation->message = $request->message;
    	$reservation->status = false;
    	$reservation->save();

    	Toastr::success('Reservation request sent successfully! You will notify soon!', 'Success', ["positionClass" => "toast-top-right"]);
    	return redirect()->back();
    }

    public function index()
    {
        $reservations = Reservation::all();
        return view('admin.reservation.index', compact('reservations'));
    }

    public function status($id)
    {
        $reservation = Reservation::find($id);
        $reservation->status = true;
        $reservation->save();
        return redirect()->back();
    }

    public function cancel($id)
    {
        $reservation = Reservation::find($id);
        $reservation->status = false;
        $reservation->save();
        return redirect()->back();
    }

    public function show($id)
    {
        $reservation = Reservation::find($id);
        return view('admin.reservation.show', compact('reservation'));
    }

    public function destroy($id)
    {
        $reservation = Reservation::find($id);
        $reservation->delete();
        return redirect()->back();
    }
}
