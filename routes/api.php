<?php
/**
 * Все маршруты в api.php возможно использовать только при предъявлении токена доступа(access_token)
 **/
Route::group(['namespace' => 'Api'], function () {
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

    //График
    Route::group(['namespace' => 'Schedules'], function () {
        Route::resource('/schedules', 'SchedulesController');
    });

    //Должности
    Route::group(['namespace' => 'Roles'], function () {
        Route::resource('/roles', 'RolesController');
    });

    //Информация о СТО
    Route::group(['namespace' => 'Sto'], function () {
        Route::resource('/sto', 'StoController');
    });

    //Услуги
    Route::group(['namespace' => 'Services'], function () {
        Route::resource('/services', 'ServiceController');
        Route::post('/services/findByType', 'ServiceController@findByType');
    });
});

