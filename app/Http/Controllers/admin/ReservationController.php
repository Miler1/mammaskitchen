<?php

namespace App\Http\Controllers\admin;

use App\Reservation;
use Illuminate\Http\Request;
use Yoeunes\Toastr\Toastr;
use App\Http\Controllers\Controller;
use Notification;
use App\Notifications\ReservationConfirmed;

class ReservationController extends Controller
{
    public function index()
    {
    	$reservations = Reservation::all();
    	return view('admin.reservation.index',compact('reservations'));
    }

    public function status($id) 
    {
    	$reservation = Reservation::find($id);
    	$reservation->status = true;
    	$reservation->save();
        Notification::route('mail',$reservation->email)
            ->notify(new ReservationConfirmed());
    	toastr()->success('Reservation successfully confirmed','Success',['positionClass'=>'toast-top-right']);
    	return redirect()->back();
    }

    public function destroy($id)
    {
    	Reservation::find($id)->delete();
    	toastr()->success('Reservation successfully deleted','Success',['positionClass'=>'toast-top-right']);
    	return redirect()->back();
   	}
}
