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
        Route::post('/users/myself', 'UserController@myself');
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

    Route::group(['namespace' => 'Categories'], function () {
        Route::resource('/categories', 'CategoryController');
    });


    Route::group(['namespace' => 'Channels', 'middleware' => 'auth:api'], function () {
        Route::group(['middleware' => 'role:admin'], function () {
            Route::apiResource('/channels', 'ChannelController')->middleware('role:admin');
        });

        Route::group(['middleware' => 'auth:api'], function () {
            Route::apiResource('/channels', 'ChannelController')->only(['index', 'show']);
        });

        Route::post('/channels/filterByArrayName', 'ChannelController@filterByArrayName');
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


    //Обучение
    Route::group(['namespace' => 'Lean'], function () {
        Route::group(['namespace' => 'Sections'], function () {
            Route::resource('/lean/sections', 'SectionController');
        });
        Route::group(['namespace' => 'Lessons'], function () {
            Route::resource('/lean/lessons', 'LessonController');
        });
    });
});

