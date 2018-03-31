<?php 
Route::get('/users-promoter', 'PromoterController@see');
Route::post('/add-promoter', 'PromoterController@store');
Route::get('/promoter', 'PromoterController@thisPromoter');
Route::put('/promoter/{id}/edit', 'PromoterController@edit');
Route::delete('/promoter/{id}/delete', 'PromoterController@delete');