<?php 
Route::get('/users-bookingagent', 'BookingAgentController@see');
Route::post('/add-bookingagent', 'BookingAgentController@store');
Route::get('/booking-agent', 'BookingAgentController@thisBookingAgent');
Route::put('/booking-agent/{id}/edit', 'BookingAgentController@edit');
Route::delete('/booking-agent/{id}/delete', 'BookingAgentController@delete');