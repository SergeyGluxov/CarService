<?php

use GuzzleHttp\Client;
use Illuminate\Http\Request;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/
Route::group(['middleware' => ['json.response']], function () {

    Route::middleware('auth:api')->get('/user', function (Request $request) {
        return $request->user();
    });

    // public routes
    Route::post('/login', 'Api\AuthController@login')->name('login.api');
    Route::post('/register', 'Api\AuthController@register')->name('register.api');

    // private routes
    Route::middleware('auth:api')->group(function () {
        Route::get('/logout', 'Api\AuthController@logout')->name('logout');
    });

});
//Route::group(['namespace' => 'Api'], function () {
//    Route::group(['namespace' => 'Auth'], function () {
//        Route::post('register', 'RegisterController');
//        Route::post('login', 'LoginController');
//        Route::post('logout', 'LogoutController')->middleware('auth:api');
//    });
//});
//Route::get('/user', function (Request $request) {
//    $http = new GuzzleHttp\Client;
//
//    $response = $http->request('GET', '/api/user', [
//        'headers' => [
//            'Accept' => 'application/json',
//            'Authorization' => 'Bearer eyJ0eXAiOiJKV1QiLCJhbGciOiJSUzI1NiIsImp0aSI6IjNlYTExYWJmMjhhMWI5OGQ2YTI2ZjIyNjg1YmVlZTczNzEyOWExNWFkZjk4OGNlM2RmOTY2MTYzOGZjNTM1MjY0ZWQ5MmE4MDUyZDRhYzZlIn0.eyJhdWQiOiIxMSIsImp0aSI6IjNlYTExYWJmMjhhMWI5OGQ2YTI2ZjIyNjg1YmVlZTczNzEyOWExNWFkZjk4OGNlM2RmOTY2MTYzOGZjNTM1MjY0ZWQ5MmE4MDUyZDRhYzZlIiwiaWF0IjoxNTY0MDA0MDEyLCJuYmYiOjE1NjQwMDQwMTIsImV4cCI6MTU5NTYyNjQxMiwic3ViIjoiMSIsInNjb3BlcyI6WyIqIl19.GSnUU0EIwiioY2GUnCV725rbKQ1lLwqAOM41zAs4qsQiIEfQ85vjFVMz8pBFVJs5m_e3GjaYJSOtAUeWLvODOkKZ0ixIiNENjpjfNA9zBFyz2Rubz1MmlkWt0ETcDIefZoW6sZcSP31RRg3VJdZ5CZ6DRyi8lV-9qaRA22kIVQ2SqJ4gFxZxvC5IgwK9qoDkzItVJ9I-wCQ0Qqj-6ZOeD0PxEAkD_Lhebhau1Cbs05Jh70JMe5F15SvL19ujVtbzaKwX2xtk27WlGZl5ntEOdpDybw5Nvly6yxU0vBODlGxhng9JFLxn-0NPkbGZtG-6SB7QRWEkiwICqaR_fNHe8zn6GV61lkbvvnpzsW4x5wnH8Yc8k5uXvMO_HuNazbxbf0fluEFS6u-kVrAGqCWYArwB5aYalHb5L12EpjQMdxJ82UpRUeXzuq20KR9Bl0J0WuZ-FmPzkSRGsRwzs-ozXsMLSTbGlvqYDWXmYpASb9R3mOrY5amGElLDLuXOIpLxz4Su5Y4n_AvYId2upZavvKFCM9ImOl94-buE1DlQYUWzpQRmJPvMqlJX4v9pz-knJJbZH95VWjpiBzYG3FxQ_2jasBhHBfbFfG3d_4X_rOt6dFgoWZ1W1cuZN6hzlOZbLmK3wWJNRSzO9gJ9-LcxkC5B2CMCO5cVhkAzMW0zEDY',
//        ],
//    ]);
//
//    return json_decode((string) $response->getBody(), true);
//});