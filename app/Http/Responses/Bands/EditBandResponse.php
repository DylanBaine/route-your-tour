<?php

namespace App\Http\Responses\Bands;

use Illuminate\Contracts\Support\Responsable;
use \App\Band;

class EditBandResponse implements Responsable{

	public function toResponse(){

		$band = Band::find($id);

		$band->name = request('name');

		$band->location = request('location');

		$band->soundcloud_url = request('soundcloud_url');

		$band->bio = request('bio');

		$band->slug = str_slug($band->name) . '-' . rand(1,999) ;

		if($request->hasFile('banner')){
			
			File::delete('storage/' . $band->banner);

			$image = $request->file('banner');
			$imageUrl = Auth::user()->id . '-' . $band->slug . '-' . time() . '.jpg';

			Image::make($image)->save(public_path('storage/' . $imageUrl));

			$band->banner = $imageUrl;

		}

		$band->save();
	}

}