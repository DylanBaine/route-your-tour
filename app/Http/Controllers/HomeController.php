<?php

namespace App\Http\Controllers;

use Auth;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use File;
use Image;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $user = Auth::user();
        return view('home')->with('user');
    }

    public function changeAvatar(Request $request)
    {
       $user = Auth::user();         

            if($request->hasFile('avatar')){
                File::delete('storage/'.$user->avatar);
            }          

            $image = $request->file('avatar');

            $imageURL = Auth::user()->id . '-' . time() . '.jpg';

            Image::make($image)->save(public_path('storage/'. $imageURL));

            $user->avatar = $imageURL;

            $user->save();

        return redirect()->back();
    }

    public function editUser(Request $request){
        $user = Auth::user();

        $user->name = request('name');
        if(request('password')){
            $user->password = bcrypt(request('password'));
        }
        $user->email = request('email');
        $user->theme = request('theme');

        $user->save();
    }

}
