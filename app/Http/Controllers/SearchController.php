<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class SearchController extends Controller
{
	public function formComponent($model, $param){

		switch ($model){
			case 'venue' :
				return \App\Venue::where('name', 'like', '%'. $param . '%')
								->orwhere('address', 'like',  '%'. $param . '%')
								->orwhere('category', 'like',  '%'. $param . '%')
								->get();
				break;
			case 'user' :
				return \App\User::where('name', 'like', '%'. $param . '%')
								->get();
				break;
			case 'band' :
				return \App\Band::where('name', 'like', '%'. $param . '%')
								->orwhere('location', 'like',  '%'. $param . '%')
								->orwhere('primary_genre', 'like', '%'. $param . '%')
								->orwhere('sub_genre', 'like', '%'. $param . '%')
								->get();
				break;
			case 'promoter' :
				return \App\Promoter::where('name', 'like', '%'. $param . '%')
								->orwhere('address', 'like',  '%'. $param . '%')
								->orwhere('category', 'like',  '%'. $param . '%')
								->get();
				break;

			}
	}

}
