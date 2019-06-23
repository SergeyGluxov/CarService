<?php


Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
Route::post('/home', 'CarController@addCar')->name('show');
Route::post('/a', 'HomeController@s')->name('SSS');