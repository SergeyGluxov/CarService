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
        Route::get('/workers', 'UserController@getWorkers');
        Route::post('/workersFree', 'UserController@getWorkersFree');
        Route::get('/users/paginate', 'PaginateController');
    });

    //Автомобили
    Route::group(['namespace' => 'Car'], function () {
        Route::resource('/cars', 'CarsController');
        Route::post('/cars/findByModel', 'CarsController@findByMark');
    });

    //Записи
    Route::group(['namespace' => 'Appointment'], function () {
        Route::resource('/appointment', 'AppointmentController');
        Route::post('/admin/appointment/', 'AppointmentController@storeAdmin');
        Route::post('/admin/appointment/status', 'AppointmentController@changeStatusAdmin');
        Route::post('/admin/appointment/getFreeTime', 'AppointmentController@getFreeTime');
        Route::get('/admin/appointment/exportExcel', 'AppointmentController@excel');
    });

    //График
    Route::group(['namespace' => 'Schedules'], function () {
        Route::resource('/admin/schedules', 'SchedulesController');
    });

    //Должности
    Route::group(['namespace' => 'Roles'], function () {
        Route::resource('/roles', 'RolesController');
        Route::post('/roles/setUser', 'RolesController@storeUserRole');
        Route::post('/roles/delete', 'RolesController@deleteRole');
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

