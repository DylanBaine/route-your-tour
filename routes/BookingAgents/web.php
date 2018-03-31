<?php 
Route::get('/booking-agents', 'BookingAgentController@allBookingAgentsPage');
Route::get('/booking-agents/{slug}', 'BookingAgentController@guestView');