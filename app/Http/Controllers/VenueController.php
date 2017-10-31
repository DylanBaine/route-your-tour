<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Venue;
use App\User;
use Auth;

class VenueController extends Controller
{
    public function store(Request $request)
    {

    	$user = User::where('id', Auth::user()->id)->first();

    	$venue = new Venue;

    	$venue->name = request('name');

    	$venue->address = request('location');

        $venue->slug = request('slug');

        $venue->save();

        $user->venues()->attach($venue->id);
    }

   public function see()
   {

   	return Auth::user()->venues()->orderBy('created_at', 'desc')->get();

   }
}
