<?php 
Route::get('/bands', 'BandController@allBandsPage');
Route::get('bands/{slug}', 'BandController@guestView');
Route::get('/bands/{band_slug}/{route_slug}', 'BandController@routes');
Route::get('bands/genre/{genre}', 'BandController@genreView');


Route::resource('bands', 'Bands/WebResourceController');