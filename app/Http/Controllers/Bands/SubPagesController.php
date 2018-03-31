<?php 

namespace Http\Controllers\Bands;

class BandSubPagesController extends Controller{

	public function routes($band_slug, $route_slug)
	{
		$band = Band::where('slug', $band_slug)->first();
		$route = $band->routes->where('slug', $route_slug)->first();

		return view('band-route', compact('band', 'route'));
	}

}