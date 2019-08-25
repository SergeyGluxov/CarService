<?php

Route::group(['namespace' => 'Api'], function () {
   //Авторизация(с токенами)
    Route::group(['namespace' => 'Auth'], function () {
        Route::post('logout', 'LogoutController');
    });
    //Пользователь
    Route::group(['namespace' => 'User'], function () {
        Route::resource('/users', 'UserController');
        Route::get('/users/paginate', 'PaginateController');
    });
    //Записи
    Route::group(['namespace' => 'Appointment'], function () {
        Route::resource('/appointment', 'AppointmentController');
    });
});

