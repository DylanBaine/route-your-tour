<?php
	/*-- MAIL TEST --*/
Route::get('mail/verify-email', function(){
	return new App\Mail\ConfirmEmail();
});

Route::get('/', function () {
	return view('welcome');
});
Route::get('/pricing', function(){
	return view('pricing');
});
Route::get('/contact', function(){
	return view('contact');
});
Route::get('/logout', function(){
	Auth::logout(Auth::user()->id);
	return redirect('/');
});

Route::post('/contact-form', 'HomeController@contactForm');
	
Route::get('/home', 'HomeController@index')->name('home');

Route::get('/venues', 'VenueController@allVenuesPage');
Route::get('/venues/{slug}', 'VenueController@guestView');
Route::get('/venues/in/{country}', 'VenueController@countryView');
Route::get('/venues/category/{category}', 'VenueController@categoryView');

Route::get('/bands', 'BandController@allBandsPage');
Route::get('bands/{slug}', 'BandController@guestView');
Route::get('/bands/{band_slug}/{route_slug}', 'BandController@routes');
Route::get('bands/genre/{genre}', 'BandController@genreView');

Route::get('/promoters', 'PromoterController@allPromotersPage');
Route::get('/promoters/{slug}', 'PromoterController@guestView');

Route::get('/booking-agents', 'BookingAgentController@allBookingAgentsPage');
Route::get('/booking-agents/{slug}', 'BookingAgentController@guestView');

Route::get('/tours', 'RouteController@allRoutesPage');

Route::get('/verifying/{token}', 'HomeController@verifyUser');

Route::middleware('level:starter')->group(function(){
	Route::get('/starter', function(){
		return 'Starter';
	});
});

Route::middleware('level:premium')->group(function(){
	Route::get('/premium', function(){
		return 'premium';
	});
});

Route::middleware('level:platinum')->group(function(){
	Route::get('/platinum', function(){
		return 'platinum';
	});
});

Route::prefix('signup')->group(function(){
	Route::get('premium', function(){
		return ('premium');
	});
});

Route::prefix('/api')->group(function(){	
	Route::get('venues/search={param}', 'VenueController@search');

	Route::post('/verify-email', 'HomeController@sendEmail');

		/*----API FOR SEARCH COMPONENT----*/
	Route::get('{model}/search/param={param}', 'SearchController@formComponent');

		/*----GET CURRENT USER THAT IS LOGGED IN----*/
	Route::get('/user', function(){
		return Auth::user();
	});	

		/*----EDIT CURRENT USER THAT IS LOGGEGD IN----*/
	Route::put('/user', 'HomeController@editUser');
	Route::put('/change-avatar', 'HomeController@changeAvatar');

		/*----API BAND CONTROLLERS----*/
	Route::get('/users-bands', 'BandController@see');
	Route::post('/add-band', 'BandController@store');
	Route::get('/band/{slug}', 'BandController@thisBand');
	Route::put('/band/{id}/edit', 'BandController@edit');
	Route::delete('/band/{id}/delete', 'BandController@delete');

		/*----API VENUE CONTROLLERS----*/
	Route::get('all-venues', 'VenueController@allVenues');
	Route::get('/users-venues', 'VenueController@see');
	Route::post('/add-venue', 'VenueController@store');
	Route::get('/venue/{slug}', 'VenueController@thisVenue');
	Route::put('/venue/{id}/edit', 'VenueController@edit');
	Route::delete('/venue/{id}/delete', 'VenueController@delete');

		/*----API PROMOTER CONTROLLERS----*/
	Route::get('/users-promoter', 'PromoterController@see');
	Route::post('/add-promoter', 'PromoterController@store');
	Route::get('/promoter', 'PromoterController@thisPromoter');
	Route::put('/promoter/{id}/edit', 'PromoterController@edit');
	Route::delete('/promoter/{id}/delete', 'PromoterController@delete');

		/*----API BOOKING AGENT CONTROLLERS----*/
	Route::get('/users-bookingagent', 'BookingAgentController@see');
	Route::post('/add-bookingagent', 'BookingAgentController@store');
	Route::get('/booking-agent', 'BookingAgentController@thisBookingAgent');
	Route::put('/booking-agent/{id}/edit', 'BookingAgentController@edit');
	Route::delete('/booking-agent/{id}/delete', 'BookingAgentController@delete');

		/*---API ROUTE CONTROLLERS---*/
	Route::post('/band/add-route', 'RouteController@create');
	Route::get('/band/{band_slug}/{route_slug}', 'RouteController@edit');
	Route::put('/{id}/edit', 'RouteController@update');
	Route::delete('/{route_id}/delete', 'RouteController@deleteRoute');
	Route::post('/{route_id}/add-location', 'RouteController@addLocation');
	Route::get('/{band_slug}/routes', 'RouteController@index');
	Route::get('/{band_slug}/{route_slug}/locations', 'RouteController@locations');
	Route::get('/{band_slug}/{route_slug}/locations-address', 'RouteController@locationsAddress');
	Route::delete('/{location_id}/delete-location', 'RouteController@deleteLocation');
	Route::put('/{location_id}/confirm-location', 'RouteController@confirmLocation');
	Route::post('/{route_id}/confirm-all', 'RouteController@confirmAll');
	
});

Auth::routes();
