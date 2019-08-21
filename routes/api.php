<?php

Route::resource('/users', 'UserController')->middleware('auth:api');
Route::resource('/appointment', 'AppointmentController')->middleware('auth:api');
Route::group(['namespace' => 'Api'], function () {
    Route::group(['namespace' => 'Auth'], function () {
        Route::post('register', 'RegisterController');
        Route::post('login', 'LoginController');
        Route::post('logout', 'LogoutController')->middleware('auth:api');
    });
});