<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\BookingAgent;
use App\User;
use Auth;

class BookingAgentController extends Controller
{
	public function store(Request $request)
	{

   		$user = User::where('id', Auth::user()->id)->first();

    	$bookingAgent = new BookingAgent;

    	$bookingAgent->name = request('name');

        $bookingAgent->slug = request('slug');

        $bookingAgent->experience = request('experience');

        $bookingAgent->user_id = $user->id;

        $bookingAgent->save();
	}

	public function see()
	{
		if(Auth::user()->bookingAgent){
			return Auth::user()->bookingAgent->first();
		}else{
			return 'No Booking Agent';
		}
	}	

	public function thisBookingAgent()
	{
		return Auth::user()->bookingAgent->first();
	}

	public function edit($id, Request $request)
	{
		$BookingAgent = BookingAgent::where('id', $id)->first();

		$BookingAgent->name = request('name');

		$BookingAgent->experience = request('experience');

		$BookingAgent->save();
	}

	public function delete($id)
	{
		$bookingAgent = BookingAgent::find($id);

		$bookingAgent->delete();
	}
}
