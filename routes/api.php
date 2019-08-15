<?php

Route::resource('/users', 'UserController')->middleware('auth:api');
Route::resource('/appointment', 'AppointmentController')->middleware('auth:api');