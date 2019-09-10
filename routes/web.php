<?php

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
Route::post('/home', 'CarController@addCar')->name('addCar');
Route::get('home/service/checkup', 'CarController@checkup')->name('checkup');

/**TODO: Определить группу маршрутов**/
Route::get('/admin', function () {
    return view('admin');
})->middleware('auth')->middleware('role:admin')->name('admin');
Route::get('admin/checkup_settings', 'AdminController@getCheckup');
Route::get('admin/users_settings', 'AdminController@getUsers');
Route::get('admin/oauth_clients', function () {
    return view('admin_layouts/oauth_clients');
});

Route::get('/redirect', 'Api\AuthController@redirect');
Route::get('/callback', 'Api\AuthController@callback');

Route::resource('/sto', 'StoController');

Route::group(['namespace' => 'Api'], function () {
    Route::group(['namespace' => 'Auth'], function () {
        Route::post('auth/login', 'LoginController');
        Route::post('auth/register', 'RegisterController');
    });
});

//Route::get('/user','HomeController@s');
//Route::get('/users','HomeController@s');
//Route::get('/users_aa', function () {
//    $response = (new GuzzleHttp\Client)->get('http://carservice.com/api/users', [
//        'headers' => [
//            'Authorization' => 'Bearer '.session()->get('token.access_token')
//        ]
//    ]);
//
//    return json_decode((string) $response->getBody(), true);
//});