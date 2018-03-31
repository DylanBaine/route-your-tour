<?php 

namespace Http\Responses\Bands;

use Illuminate\Contracts\Support\Responsable;

class WebIndexBandResponse implements Responsable {


	public function toResponse(){

		$param = \Request::get('search');

		if($param == NULL){

			$bands = Band::orderBy('created_at', 'desc')->paginate(12);

		}elseif($param != NULL){
			
			$bands = Band::where('name', 'like', '%'. $param . '%')
			->orwhere('location', 'like',  '%'. $param . '%')
			->orwhere('primary_genre', 'like', '%'. $param . '%')
			->orwhere('sub_genre', 'like', '%'. $param . '%')
			->orderBy('created_at', 'desc')->paginate(12);
			
		}

		return view('bands', compact('bands'));

	}
}