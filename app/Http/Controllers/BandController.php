<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Band;
use App\User;
use Auth;
use Image;
use File;

class BandController extends Controller
{
    public function store(Request $request)
    {
    	$user = User::where('id', Auth::user()->id)->first();

    	$band = new Band;

    	$band->name = request('name');

    	$band->soundcloud_url = request('soundcloud_url');

        $band->location = 'null';

        $band->slug = request('slug');

        $band->save();

        $user->bands()->attach($band->id);
    }

    public function see()
    {
        return Auth::user()->bands()->orderBy('created_at', 'desc')->get();
    }

    public function thisBand($slug)
    {
       return $band = Band::where('slug', $slug)->first();
    }

    public function edit($id, Request $request)
    {
        $band = Band::find($id);

        $band->name = request('name');

        $band->location = request('location');

        $band->soundcloud_url = request('soundcloud_url');

        $band->bio = request('bio');

        if($request->hasFile('banner')){
            
            File::delete('storage/' . $band->banner);

            $image = $request->file('banner');
            $imageUrl = Auth::user()->id . '-' . $band->slug . '-' . time() . '.jpg';

            Image::make($image)->save(public_path('storage/' . $imageUrl));

            $band->banner = $imageUrl;

        }

        $band->save();

    }


    public function delete($id)
    {
        Band::find($id)->delete();
    }
}
