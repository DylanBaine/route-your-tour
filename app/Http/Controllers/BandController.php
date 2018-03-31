<?php
namespace App\Http\Controllers;

use Auth;
use App\Band;
use App\Http\Repositories\BandRepository;
use Exception;
use File;
use Image;
use Illuminate\Http\Request;
use App\User;

class BandController extends Controller
{
	private $band;

	public function __construct(BandRepository $band)
	{
		$this->band = $band;
	}

/*	public function allBandsPage(){
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

	public function guestView($slug){
		$page = Band::where('slug', $slug)->first();
		$page->times_visited += 1;
		$page->save();
		$type = 'bands';
		return view('profile', compact('page', 'type'));
	}*/
/*
	public function store(Request $request)
	{
		$user = Auth::user();

		if($user->premium_level > 1){

			$band = new Band;

			$band->name = request('name');

			$band->soundcloud_url = request('soundcloud_url');

			$band->location = 'null';

			$band->slug = request('slug');

			$band->save();

			$user->bands()->attach($band->id);

		}else if($user->premium_level < 2 && $user->bands->count() != 1 ){

			$band = new Band;

			$band->name = request('name');

			$band->soundcloud_url = request('soundcloud_url');

			$band->location = 'null';

			$band->slug = request('slug');

			$band->save();

			$user->bands()->attach($band->id);
		}else{

			throw new Exception("You already have one band... To add more, sign up for a Premium Account.", 1);
			
		}
	}*/

/*	public function see()
	{
		return $this->band->allProfiles();
	}*/

/*	public function thisBand($slug)
	{
		return $this->band->profileBySlug($slug);
	}*/

/*	public function edit($id, Request $request)
	{
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

	}*/

/*	public function routes($band_slug, $route_slug)
	{
		$band = Band::where('slug', $band_slug)->first();
		$route = $band->routes->where('slug', $route_slug)->first();

		return view('band-route', compact('band', 'route'));
	}*/

/*	public function delete($id)
	{
		Band::find($id)->delete();
	}*/
}
