<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Band;
use App\User;
use Auth;

class BandController extends Controller
{
    public function store(Request $request)
    {
    	$user = User::where('id', Auth::user()->id)->first();

    	$band = new Band;

    	$band->name = request('name');

    	$band->location = request('location');

    	$band->soundcloud_url = request('soundcloud_url');

        $band->slug = request('slug');

        $band->save();

        $user->bands()->attach($band->id);
    }

    public function see()
    {
        return Auth::user()->bands()->orderBy('created_at', 'desc')->get();
    }
}
