<?php 
Route::get('all-venues', 'VenueController@allVenues');
Route::get('/users-venues', 'VenueController@see');
Route::post('/add-venue', 'VenueController@store');
Route::get('/venue/{slug}', 'VenueController@thisVenue');
Route::put('/venue/{id}/edit', 'VenueController@edit');
Route::delete('/venue/{id}/delete', 'VenueController@delete');