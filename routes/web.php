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

		/*----API VENUE CONTROLLERS----*/
	Route::get('/users-venues', 'VenueController@see');
	Route::post('/add-venue', 'VenueController@store');

	/*----API PROMOTER CONTROLLERS----*/
	Route::get('/users-promoter', 'PromoterController@see');
	Route::post('/add-promoter', 'PromoterController@store');

	/*----API BOOKING AGENT CONTROLLERS----*/
	Route::get('/users-bookingagent', 'BookingAgentController@see');
	Route::post('/add-bookingagent', 'BookingAgentController@store');

});
