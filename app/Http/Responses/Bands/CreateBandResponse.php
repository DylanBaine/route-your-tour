<?php 

namespace App\Http\Bands\Responses;

use Auth;
use Illuminate\Contracts\Support\Responsable;

class CreateBandResponse implements Responsable {

	public function toResponse($request){

		$user = Auth::user();

		if($user->canAddProfile()){

			$this->store($request);

		}else{
			throw new Exception("You already have one band... To add more, sign up for a Premium Account.", 1);
		}

	}

	public function store($request){

		$band = new Band;

		$band->name = request('name');

		$band->soundcloud_url = request('soundcloud_url');

		$band->location = 'null';

		$band->slug = request('slug');

		$band->save();

		$user->bands()->attach($band->id);	
	}

}