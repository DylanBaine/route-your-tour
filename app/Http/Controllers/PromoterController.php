<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Promoter;
use App\User;
use Auth;

class PromoterController extends Controller
{
	public function store(Request $request)
	{

   		$user = User::where('id', Auth::user()->id)->first();

    	$promoter = new Promoter;

    	$promoter->name = request('name');

        $promoter->slug = request('slug');

        $promoter->experience = request('experience');

        $promoter->user_id = $user->id;

        $promoter->save();
	}

	public function see()
	{
		return Auth::user()->promoter->first();
	}

	public function thisPromoter()
	{
		return Auth::user()->promoter->first();
	}

	public function edit($id, Request $request)
	{
		$promoter = Promoter::where('id', $id)->first();

		$promoter->name = request('name');

		$promoter->experience = request('experience');

		$promoter->save();
	}

	public function delete($id)
	{
		$promoter = Promoter::find($id);

		$promoter->delete();
	}
}
