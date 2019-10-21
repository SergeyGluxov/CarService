<?php

Route::get('/', function () {
    return view('welcome');
});

//Веб-маршруты(сайта), в итоге нужно убрать и оставить только API маршруты
Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
Route::post('/home', 'CarController@addCar')->name('addCar');
Route::get('home/service/checkup', 'CarController@checkup')->name('checkup');
Route::get('/admin', function () {
    return view('admin');
})->middleware('auth')->middleware('role:admin')->name('admin');
Route::get('admin/checkup_settings', 'AdminController@getCheckup');
Route::get('admin/users_settings', 'AdminController@getUsers');
Route::get('admin/oauth_clients', function () {
    return view('admin_layouts/oauth_clients');
});
//------------------------------------------------------------------------
//Публичные API-маршруты(здесь маршруты достуны без авторизации токеном)
//**Неймспейсы показывают рассположение контроллеров
Route::group(['namespace' => 'Api'], function () {
    Route::group(['namespace' => 'Auth'], function () {
        Route::post('auth/login', 'LoginController');
        Route::post('auth/register', 'RegisterController');
    });
    Route::group(['namespace' => 'News'], function () {
        Route::resource('/news', 'NewsController');
    });
});
//Эти маршруты для авторизации стороних приложений через carservice
Route::get('/redirect', 'Api\AuthController@redirect');
Route::get('/callback', 'Api\AuthController@callback');


