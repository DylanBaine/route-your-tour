<?php 
Route::get('/venues', 'VenueController@allVenuesPage');
Route::get('/venues/{slug}', 'VenueController@guestView');
Route::get('/venues/in/{country}', 'VenueController@countryView');
Route::get('/venues/category/{category}', 'VenueController@categoryView');