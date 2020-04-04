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
//Записи на осмотр
Route::get('admin/checkup_settings', 'AdminController@getCheckup');
//Пользователи системы
Route::get('admin/users_settings', 'AdminController@getUsers');
//Рассписание работ
Route::get('admin/schedules', 'AdminController@getSchedules');
//Назначить сотрудника
Route::get('admin/add_employee', 'AdminController@stroreEmployee');
Route::get('admin/remove_employee', 'AdminController@removeEmployee');
//Должности
Route::get('admin/add_role', 'AdminController@addRole');
Route::get('admin/remove_role', 'AdminController@removeRole');

//Поиск мастеров
Route::get('admin/search_master', 'AdminController@searchMaster');

Route::get('admin/oauth_clients', function () {return view('admin_layouts/oauth_clients');});
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


