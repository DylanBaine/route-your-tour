<?php 
Route::get('/promoters', 'PromoterController@allPromotersPage');
Route::get('/promoters/{slug}', 'PromoterController@guestView');