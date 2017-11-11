<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

Route::get('/venues', 'VenueController@allVenuesPage');
Route::get('venues/{slug}', 'VenueController@guestView');


route::get('/user', function(){
	return Auth::user();
});



Route::prefix('api')->group(function () {

		/*----GET CURRENT USER THAT IS LOGGED IN----*/
	Route::get('/user', function(){
		return Auth::user();
	});	

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
	Route::get('venues/search={param}', 'VenueController@search');

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
	Route::delete('/{route_id}/delete', 'RouteController@delete');
	Route::post('/{route_id}/add-location', 'RouteController@addLocation');
	Route::get('/{band_slug}/routes', 'RouteController@index');
	Route::get('/{band_slug}/{route_slug}/locations', 'RouteController@locations');
	Route::delete('/{location_id}/delete-location', 'RouteController@deleteLocation');
	Route::put('/{location_id}/confirm-location', 'RouteController@confirmLocation');

});
