<?php

use App\User;


Route::get('/user', function (){
    return json_decode(User::all());
})->middleware('auth:api');

Route::resource('/users', 'UserController')->middleware('auth:api');