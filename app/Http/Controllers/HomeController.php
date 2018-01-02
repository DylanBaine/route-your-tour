<?php

namespace App\Http\Controllers;

use Auth;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use File;
use Image;
use \App\User;

use Illuminate\Mail\Mailer;
use Mail;
use App\Mail\ConfirmEmail;

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
		if(request('email') != $user->email){
			$user->email_confirmed_token = str_random(10);		
			$user->email_verified = 0;
		}
		$user->email = request('email');
		$user->theme = request('theme');

		$user->save();
	}

	public function sendEmail(){
/*		$user = Auth::user();
		$data = [
			'sendTo' => $user->email,
			'name' => $user->name,
			'userToken' => $user->email_confirmed_token
		];

		Mail::send(new ConfirmEmail(), $data, function($message) use ($data){
			$message->from('noreply@routeyourtour.com');
			$message->to($data['sendTo']);
			$message->subject('Welcome to Route Your Tour, ' . $data['name']);
		});*/

		Mail::to(Auth::user()->email)->send(new ConfirmEmail());
	}

	public function verifyUser($email, $token){
		$user = User::whereRaw('email', $email)->orWhere('email_confirmed_token', $token)->first();

		$user->email_verified = 1;

		$user->save();

		return redirect('/home');
	}

}
