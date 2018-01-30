<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Venue;
use App\User;
use Auth;
use File;
use Image;
use Exception;

class VenueController extends Controller
{

	public function allVenuesPage()
	{
			$param = \Request::get('search');
			if($param == NULL){
					$venues = Venue::orderBy('created_at', 'desc')->paginate(12);
			}elseif($param != NULL){
					$venues = Venue::where('name', 'like', '%'. $param . '%')
									->orwhere('address', 'like',  '%'. $param . '%')
									->orwhere('category', 'like',  '%'. $param . '%')
									->orderBy('created_at', 'desc')->paginate(12);
			}
			return view('venues', compact('venues', 'param'));
	}

	public function countryView($country){
		$param = '';
		$venues = Venue::where('country_slug', $country)->paginate(12);
		return view('venues', compact('venues', 'param'));
	}

	public function categoryView($category){
			$param = '';

			$venues = Venue::where('category_slug', $category)->orderBy('created_at', 'desc')->paginate(12);

			return view('venues', compact('venues', 'param'));
	}

	public function guestView($slug)
	{
		$page = Venue::where('slug', $slug)->first();
		$page->times_visited += 1;
		$page->save();
		$type = 'venues';
		return view('profile', compact('page', 'type'));
	}

	public function allVenues()
	{
		return Venue::orderBy('created_at', 'desc')->get();
	}

	public function store(Request $request)
	{

		$user = Auth::user();

		if($user->premium_level > 1){

			$venue = new Venue;

			$venue->name = request('name');

			$venue->address = request('location');

			$venue->slug = request('slug');

			$venue->category = request('category');

			$venue->category_slug = str_slug(request('category'));

			$venue->country = request('country');

			$venue->country_slug = str_slug(request('country'));

			$venue->save();

			$user->venues()->attach($venue->id);

		}else if($user->premium_level < 2 && $user->venues->count() != 1 ){

			$venue = new Venue;

			$venue->name = request('name');

			$venue->address = request('location');

			$venue->slug = request('slug');

			$venue->category = request('category');

			$venue->category_slug = str_slug(request('category'));

			$venue->country = request('country');

			$venue->country_slug = str_slug(request('country'));

			$venue->save();

			$user->venues()->attach($venue->id);
		}else{

			throw new Exception("You already have one venue... To add more, sign up for a Premium Account.", 1);
			
		}
	}

	public function see()
	{

		return Auth::user()->venues()->orderBy('created_at', 'desc')->get();

	}

	public function thisVenue($slug)
	{
		return Venue::where('slug', $slug)->first();
	}

	public function edit($id, Request $request)
	{
		$venue = Venue::find($id);

		$venue->name = request('name');

		$venue->address = request('address');

		$venue->country = request('country');

		$venue->booking_email = request('booking_email');

		$venue->booking_number = request('booking_number');

		$venue->website = request('website');

		$venue->amenities = request('amenities');

		$venue->category = request('category');

		$venue->category_slug = str_slug(request('category'));

				if($request->hasFile('banner')){
						
						File::delete('storage/' . $venue->banner);

						$image = $request->file('banner');
						$imageUrl = Auth::user()->id . '-' . $venue->slug . '-' . time() . '.jpg';

						Image::make($image)->save(public_path('storage/' . $imageUrl));

						$venue->banner = $imageUrl;

				}    

		$venue->save();
	}

	public function delete($id)
	{
		Venue::find($id)->delete();
	}

	public function search($param)
	{
		return Venue::where('name', 'like', '%'. $param . '%')
			->orwhere('address', 'like',  '%'. $param . '%')
			->orwhere('category', 'like',  '%'. $param . '%')
			->get();
	}
}
