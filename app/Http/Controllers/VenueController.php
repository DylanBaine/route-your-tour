<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Venue;
use App\User;
use Auth;
use File;
use Image;

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

        if($request->hasFile('banner')){
            
            File::delete('storage/' . $venue->banner_image);

            $image = $request->file('banner');
            $imageUrl = Auth::user()->id . '-' . $venue->slug . '-' . time() . '.jpg';

            Image::make($image)->save(public_path('storage/' . $imageUrl));

            $venue->banner_image = $imageUrl;

        }    

    $venue->save();
  }

  public function delete($id)
  {
    Venue::find($id)->delete();
  }
}
