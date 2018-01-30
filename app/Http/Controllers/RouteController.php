<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use \App\Routes;
use \App\Band;
use \App\Locations;

class RouteController extends Controller
{	
	public function create(Request $request)
	{
		$route = new Routes;

		$route->title = request('title');

		$route->slug = request('slug');

		$route->band_id = request('band_id');

		$route->save();
	}

	public function index($band_slug)
	{
		$band = Band::where('slug', $band_slug)->first();

		return $band->routes()->get();
	}

	public function edit($band_slug, $route_slug)
	{
		$band = Band::where('slug', $band_slug)->first();
		$route = $band->routes()->where('slug', $route_slug)->first();
		return $route;
	}
	
	public function addLocation($route_id, Request $request)
	{

		$location = new Locations;

		$location->routes_id = request('route_id');

		$location->band_id = request('band_id');

		$location->address = request('address');

		$location->venue = request('venue');

		$location->slug = request('slug');

		$location->save();

	}

	public function locations($band_slug, $route_slug)
	{
		$band = Band::where('slug', $band_slug)->first();

		$route = $band->routes()->where('slug', $route_slug)->first();

		return $route->locations()->orderBy('created_at', 'asc')->get();
	}

	public function locationsAddress($band_slug, $route_slug)
	{
		$band = Band::where('slug', $band_slug)->first();

		$route = $band->routes()->where('slug', $route_slug)->first();

		return $route->locations()->pluck('address');
	}

	public function confirmLocation($location_id, Request $request)
	{
		$location = Locations::find($location_id);

		$location->confirmed = true;

		$location->save();
	}

	public function deleteLocation($location_id)
	{
		$location = Locations::find($location_id);

		$location->delete();
	}

	public function deleteRoute($route_id)
	{
		$route = Routes::find($route_id);

		$route->delete();
	}

	public function confirmAll($route_id)
	{
		$locations = Locations::where('routes_id', $route_id)->where('confirmed', 0)->get();

		foreach($locations as $location){
			$location->confirmed = 1;
			$location->save();
		}
	}
}
