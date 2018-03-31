<?php

namespace Http\Controllers\Bands;

use App\Band;
use Http\Responses\Bands\CreateBandResponse;

class ApiResourceController extends Controller {

	public function __construct(){

	}

	public function index(){

		return Auth::user()->bands()->get();

	}

	public function show($slug){

		return Auth::user()->bands()->where('slug', $slug)->first();
	}

	public function create(){

	}

	public function store(Request $request){
		
		return new CreateBandResponse($request);
		
	}

	public function edit(){

	}

	public function update(){

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

	public function delete($id){
		
		Band::find($id)->delete();

	}
}