<?php 
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