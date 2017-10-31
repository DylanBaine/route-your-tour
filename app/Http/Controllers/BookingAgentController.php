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
		return BookingAgent::where('user_id', Auth::user()->id)->first();
	}
}
