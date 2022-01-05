<?php

/*Route::get('/', function () {
    return view('welcome');
});*/

//Веб-маршруты(сайта), в итоге нужно убрать и оставить только API маршруты
Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

//---------------------------------АДМИНКА------------------------------------------------------------------------------
Route::get('/admin', function () {
    return view('admin');
})->middleware('auth')->middleware('role:admin')->name('admin');

//Пользователи системы
Route::get('/', 'HomeController@index');
Route::get('/admin', 'AdminController@getUsers')->middleware('auth')->middleware('role:admin');

Route::get('admin/users/', 'AdminController@getUsers')->middleware('auth')->middleware('role:admin');
Route::get('admin/users/create', 'AdminController@createUser')->middleware('auth')->middleware('role:admin');
Route::get('admin/users/delete', 'AdminController@deleteUser')->middleware('auth')->middleware('role:admin');
//Сотрудники
Route::get('admin/employee', 'AdminController@getEmployee')->middleware('auth')->middleware('role:admin');

//Услуги
Route::get('admin/services/', 'AdminController@getServices')->middleware('auth')->middleware('role:admin');

//Записи на осмотр
Route::get('admin/auto', 'AdminController@getAuto')->middleware('auth')->middleware('role:admin');
Route::get('admin/auto/models', 'AdminController@getAutoModel')->middleware('auth')->middleware('role:admin');
Route::get('admin/auto/brands', 'AdminController@getAutoBrand')->middleware('auth')->middleware('role:admin');
Route::get('admin/top/channels', 'AdminController@getTopChannels')->middleware('auth')->middleware('role:admin');
Route::get('admin/details/type', 'AdminController@getTypeDetail')->middleware('auth')->middleware('role:admin');
Route::get('admin/details/nomenclature', 'AdminController@getNomenclature')->middleware('auth')->middleware('role:admin');
Route::get('admin/details/assortment', 'AdminController@getAssortment')->middleware('auth')->middleware('role:admin');
Route::get('admin/suppliers', 'AdminController@getSuppliers')->middleware('auth')->middleware('role:admin');
Route::get('admin/suppliers/orders', 'AdminController@getOrders')->middleware('auth')->middleware('role:admin');
Route::get('admin/reservations', 'AdminController@getReservation')->middleware('auth')->middleware('role:admin');

//todo: Сделать нормальное API
Route::group(['namespace' => 'Api'], function () {
    Route::group(['namespace' => 'Channels'], function () {
        Route::resource('/channels', 'ChannelController');
        Route::get('/filter/channels', 'ChannelController@getFilterChannels');
        Route::post('/category/channels', 'ChannelController@getChannelsByCategory');
        Route::post('/paginate/channels', 'ChannelController@paginate');
        Route::get('/updateGitHub/channels', 'ChannelController@getChannelFromGitHub');
    });
    Route::group(['namespace' => 'Sources'], function () {
        Route::resource('/sources', 'SourceController');
    });
    Route::group(['namespace' => 'Categories'], function () {
        Route::resource('/categories', 'CategoryController');
    });

    Route::group(['namespace' => 'ChannelsSources'], function () {
        Route::resource('/channels/source', 'ChannelSourceController');
    });
});
//---------------------Экспорт и импорт-------------------------------------------------
//Пользователи
Route::get('admin/assortment/export', 'Api\Details\DetailCarController@export')->middleware('auth')->middleware('role:admin');
Route::post('admin/assortment/import', 'Api\Details\DetailCarController@import')->middleware('auth')->middleware('role:admin');

//Завявки
Route::get('admin/users/export', 'AdminController@getExportUser')->middleware('auth')->middleware('role:admin');
Route::post('admin/users/import', 'AdminController@importUsers')->middleware('auth')->middleware('role:admin');

//--------------------------------------------------------------------------------------

//Назначить сотрудника
Route::get('admin/employees', 'AdminController@stroreEmployee')->middleware('auth')->middleware('role:admin');
Route::get('admin/remove_employee', 'AdminController@removeEmployee')->middleware('auth')->middleware('role:admin');

//Должности
Route::get('admin/roles', 'AdminController@addRole')->middleware('auth')->middleware('role:admin');
Route::get('admin/remove_role', 'AdminController@removeRole')->middleware('auth')->middleware('role:admin');

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
        Route::resource('/assortment/details', 'DetailCarController');
        Route::post('/assortment/type/details', 'DetailCarController@getDetailCarByType');
    });

    Route::group(['namespace' => 'Orders'], function () {
        Route::resource('/orders', 'OrderController');
    });

    Route::group(['namespace' => 'Reservations'], function () {
        Route::resource('/reservations', 'ReservationController');
        Route::post('/user/reservations', 'ReservationController@getReservationUser');
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
