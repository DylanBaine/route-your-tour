<?php 
Route::get('/users-bands', 'BandController@see');
Route::post('/add-band', 'BandController@store');
Route::get('/band/{slug}', 'BandController@thisBand');
Route::put('/band/{id}/edit', 'BandController@edit');
Route::delete('/band/{id}/delete', 'BandController@delete');

Route::resource('/bands', 'Bands/ApiResourceController');