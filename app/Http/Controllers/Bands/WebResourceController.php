<?php

namespace Http\Controllers\Bands;

use Http\Responses\Bands\WebIndexBandResponse;

class ApiResourceController extends Controller {


	public function index(){

		return new WebIndexBandResponse();
	}

	public function show($slug){

		$page = Band::where('slug', $slug)->first();
		$page->times_visited += 1;
		$page->save();
		$type = 'bands';
		
		return view('profile', compact('page', 'type'));

	}

}