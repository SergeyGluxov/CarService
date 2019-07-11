<?php


Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
Route::post('/home', 'CarController@addCar')->name('addCar');
Route::get('home/service/checkup','CarController@checkup')->name('checkup');
Route::get('/admin', function () {return view('admin');})
    ->middleware('auth')
    ->middleware('role:admin')
    ->name('admin');
Route::get('admin/users_settings','AdminController@getUsers');
