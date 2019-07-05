<?php


Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
Route::post('/home', 'CarController@addCar')->name('addCar');
Route::get('/admin', function ()
{
  return view('admin');
});