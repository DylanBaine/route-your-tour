<?php namespace App\Http\Repositories;

use App\Http\Contracts\ApiInterface;
use Auth;

class BandRepository implements ApiInterface
{

	public function allProfiles(){
		return Auth::user()->bands->all();
	}

	public function profileBySlug($slug){
		return Auth::user()->bands->where('slug', $slug)->first();
	}

}