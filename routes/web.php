<?php

use Illuminate\Http\Request;
Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
Route::post('/home', 'CarController@addCar')->name('addCar');
Route::get('home/service/checkup','CarController@checkup')->name('checkup');

/**TODO: Определить группу маршрутов**/
Route::get('/admin', function () {return view('admin');})->middleware('auth')->middleware('role:admin')->name('admin');
Route::get('admin/checkup_settings','AdminController@getCheckup');
Route::get('admin/users_settings','AdminController@getUsers');
Route::get('admin/oauth_clients',function (){return view('admin_layouts/oauth_clients');});

Route::get('/redirect', function () {
    $query = http_build_query([
        'client_id' => '5',
        'redirect_uri' => 'http://localhost:8000/callback',
        'response_type' => 'code',
        'scope' => '*',
    ]);
    return redirect('http://localhost:8000/oauth/authorize?'.$query);
});
Route::get('/callback', function (Request $request) {
    $http = new GuzzleHttp\Client;

    $response = $http->post('http://localhost:8000/oauth/token', [
        'form_params' => [
            'client_id' => '5',
            'client_secret' => 'pYfk6eh8XShVKL6vMdkJVfuSzZy9Of0mU42GZM61',
            'grant_type' => 'code',
            'redirect_uri' => 'http://localhost:8000/callback',
            'code' => $request->code,
        ],
    ]);

    return json_decode((string) $response->getBody(), true);
});