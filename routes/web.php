<?php

Route::get('/', function () {
    return view('welcome');
});

//Веб-маршруты(сайта), в итоге нужно убрать и оставить только API маршруты
Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

//---------------------------------АДМИНКА------------------------------------------------------------------------------
Route::get('/admin', function () {
    return view('admin');
})->middleware('auth')->middleware('role:admin')->name('admin');

//Пользователи системы
Route::get('admin/users/', 'AdminController@getUsers');
Route::get('admin/users/create', 'AdminController@createUser');
Route::get('admin/users/delete', 'AdminController@deleteUser');
//Сотрудники
Route::get('admin/employee', 'AdminController@getEmployee');

//Услуги
Route::get('admin/services/', 'AdminController@getServices');

//Записи на осмотр
Route::get('admin/channels', 'AdminController@getCheckup');
Route::get('admin/auto', 'AdminController@getAuto');
Route::get('admin/auto/models', 'AdminController@getAutoModel');
Route::get('admin/auto/brands', 'AdminController@getAutoBrand');
Route::get('admin/top/channels', 'AdminController@getTopChannels');
Route::get('admin/details/type', 'AdminController@getTypeDetail');
Route::get('admin/details/nomenclature', 'AdminController@getNomenclature');
Route::get('admin/details/assortment', 'AdminController@getAssortment');
Route::get('admin/suppliers', 'AdminController@getSuppliers');
Route::get('admin/suppliers/orders', 'AdminController@getOrders');

//Рассписание работ
Route::get('admin/schedules', 'AdminController@getSchedules');

//---------------------Экспорт и импорт-------------------------------------------------
//Завявки
Route::get('admin/users/export', 'AdminController@getExportUser');
Route::post('admin/users/import', 'AdminController@importUsers');

//Пользователи
Route::get('admin/appointment/export', 'AdminController@getExport');
Route::post('admin/appointment/import', 'AdminController@importAppointments');
//--------------------------------------------------------------------------------------

//Назначить сотрудника
Route::get('admin/employees', 'AdminController@stroreEmployee');
Route::get('admin/remove_employee', 'AdminController@removeEmployee');

//Должности
Route::get('admin/roles', 'AdminController@addRole');
Route::get('admin/remove_role', 'AdminController@removeRole');

//Поиск мастеров
Route::get('admin/search_master', 'AdminController@searchMaster');

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


    Route::group(['namespace' => 'Cars'], function () {
        Route::resource('/car/brands', 'BrandController');
        Route::resource('/car/models', 'AvtoModelController');
        Route::post('/car/models/getModelsByBrand', 'AvtoModelController@getModelsByBrand');
        Route::post('/car/getCarsByModels', 'CarController@getCarsByModels');
        Route::resource('/cars', 'CarController');
    });

    Route::group(['namespace' => 'Details'], function () {
        Route::resource('/details', 'DetailController');
        Route::resource('/assortment/details', 'DetailCarController');
    });

    Route::group(['namespace' => 'Orders'], function () {
        Route::resource('/orders', 'OrderController');
    });

    Route::group(['namespace' => 'Factory'], function () {
        Route::resource('/factory', 'FactoryController');
    });

    Route::group(['namespace' => 'Stack'], function () {
        Route::resource('/stack', 'StackController');
    });


    Route::group(['namespace' => 'Stock'], function () {
        Route::resource('/stock', 'StockController');
    });

    Route::group(['namespace' => 'TypeDetail'], function () {
        Route::resource('/type/details', 'TypeDetailController');
    });


    Route::group(['namespace' => 'Supplier'], function () {
        Route::resource('/suppliers', 'SupplierController');
    });


    Route::group(['namespace' => 'Roles'], function () {
        Route::resource('/roles', 'RolesController');
        Route::post('/roles/setUser', 'RolesController@storeUserRole');
        Route::post('/roles/delete', 'RolesController@deleteRole');
    });
    Route::group(['namespace' => 'User'], function () {
        Route::resource('/users', 'UserController');
        Route::get('/workers', 'UserController@getWorkers');
    });
});

//Эти маршруты для авторизации стороних приложений через carservice
Route::get('/redirect', 'Api\AuthController@redirect');
Route::get('/callback', 'Api\AuthController@callback');



Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

Route::post('/mail', 'MailController@sendMessage');
