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

include('Venues/web.php');

include('Bands/web.php');

include('BookingAgents/web.php');

include('Promoters/web.php');

include('Routes/web.php');


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

	include('Bands/api.php');

	include('Venues/api.php');

	include('Promoters/api.php');

	include('BookingAgents/api.php');

	include('Routes/api.php');
	
});

Auth::routes();
