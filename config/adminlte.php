<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Title
    |--------------------------------------------------------------------------
    |
    | The default title of your admin panel, this goes into the title tag
    | of your page. You can override it per page with the title section.
    | You can optionally also specify a title prefix and/or postfix.
    |
    */

    'title' => 'Панель администратора',

    'title_prefix' => '',

    'title_postfix' => '',

    /*
    |--------------------------------------------------------------------------
    | Logo
    |--------------------------------------------------------------------------
    |
    | This logo is displayed at the upper left corner of your admin panel.
    | You can use basic HTML here if you want. The logo has also a mini
    | variant, used for the mini side bar. Make it 3 letters or so
    |
    */

    'logo' => '<b>ИП Шипилов | Admin</b>',

    'logo_mini' => '<b>A</b>DM',

    /*
    |--------------------------------------------------------------------------
    | Skin Color
    |--------------------------------------------------------------------------
    |
    | Choose a skin color for your admin panel. The available skin colors:
    | blue, black, purple, yellow, red, and green. Each skin also has a
    | ligth variant: blue-light, purple-light, purple-light, etc.
    |
    */

    'skin' => 'yellow',

    /*
    |--------------------------------------------------------------------------
    | Layout
    |--------------------------------------------------------------------------
    |
    | Choose a layout for your admin panel. The available layout options:
    | null, 'boxed', 'fixed', 'top-nav'. null is the default, top-nav
    | removes the sidebar and places your menu in the top navbar
    |
    */

    'layout' => null,

    /*
    |--------------------------------------------------------------------------
    | Collapse Sidebar
    |--------------------------------------------------------------------------
    |
    | Here we choose and option to be able to start with a collapsed side
    | bar. To adjust your sidebar layout simply set this  either true
    | this is compatible with layouts except top-nav layout option
    |
    */

    'collapse_sidebar' => false,

    /*
    |--------------------------------------------------------------------------
    | URLs
    |--------------------------------------------------------------------------
    |
    | Register here your dashboard, logout, login and register URLs. The
    | logout URL automatically sends a POST request in Laravel 5.3 or higher.
    | You can set the request to a GET or POST with logout_method.
    | Set register_url to null if you don't want a register link.
    |
    */

    'dashboard_url' => 'admin/reservations',

    'logout_url' => 'logout',

    'logout_method' => null,

    'login_url' => 'login',

    'register_url' => 'register',


    'menu' => [

        'УПРАВЛЕНИЕ АВТОМОБИЛЯМИ',
        [
            'text' => 'Автомобили',
            'url' => 'admin/channels',
            'icon' => 'search',
            'submenu' => [
                [
                    'text' => 'Список автомобилей',
                    'url' => 'admin/auto',
                ],
                [
                    'text' => 'Модели',
                    'url' => 'admin/auto/models',
                ],
                [
                    'text' => 'Бренды',
                    'url' => 'admin/auto/brands',
                ],
            ]
        ],


        'УПРАВЛЕНИЕ ПОСТАВЩИКАМИ',
        [
            'text' => 'Управление поставщиками',
            'icon' => 'search',
            'submenu' => [
                [
                    'text' => 'Поставщики',
                    'url' => 'admin/suppliers',
                ],
                [
                    'text' => 'Заявки',
                    'url' => 'admin/suppliers/orders',
                ]
            ]
        ],

        'УПРАВЛЕНИЕ БРОНИРОВАНИЯМИ',
        [
            'text' => 'Управление бронированиями',
            'url' => 'admin/reservations',
            'icon' => 'search',
        ],

        'УПРАВЛЕНИЕ ЗАПЧАСТАМИ',
        [
            'text' => 'Запчасти',
            'url' => 'admin/channels',
            'icon' => 'search',
            'submenu' => [
                [
                    'text' => 'Ассортимент',
                    'url' => 'admin/details/assortment',
                ],
                [
                    'text' => 'Номенклатура',
                    'url' => 'admin/details/nomenclature',
                ],
                [
                    'text' => 'Типы запчастей',
                    'url' => 'admin/details/type',
                ]
            ]
        ],

        'ПОЛЬЗОВАТЕЛИ',
        [
            'text' => 'Blog',
            'url' => 'admin/blog',
            'can' => 'manage-blog',
        ],
        [
            'text' => 'Список пользователей',
            'url' => 'admin/users/',
            'icon' => 'user',
        ],
        [
            'text' => 'Управление сотрудниками',
            'icon' => 'user',
            'submenu' => [
                [
                    'text' => 'Должности',
                    'url' => 'admin/roles/',
                ],
                [
                    'text' => 'Сотрудники',
                    'url' => 'admin/employees/',
                ]
            ]
        ],
        /*[
            'text' => 'Настройка OAuth',
            'icon' => 'pencil',
            'submenu' => [
                [
                    'text' => 'Клиенты',
                    'url' => 'admin/oauth_clients',
                ]
            ],
        ],*/

        /*
        'ПОИСК',
        [
            'text' => 'Найти свободных мастеров',
            'url' => 'admin/search_master',
            'icon' => 'search',
        ],
        'РАСПИСАНИЕ РАБОТ',
        [
            'text' => 'Расписание работ',
            'url' => 'admin/schedules',
            'icon' => 'car',
        ],
        'СОТРУДНИКИ',
        [
            'text' => 'Список сотрудников',
            'url' => 'admin/employee',
            'icon' => 'car',
        ],
        [
            'text' => 'Должности',
            'url' => 'admin/add_role',
            'icon' => 'car',
        ],

        'Услуги',
        [
            'text' => 'Список услуг',
            'url' => 'admin/services/',
            'icon' => 'search',
        ]*/
    ],


    'filters' => [
        JeroenNoten\LaravelAdminLte\Menu\Filters\HrefFilter::class,
        JeroenNoten\LaravelAdminLte\Menu\Filters\ActiveFilter::class,
        JeroenNoten\LaravelAdminLte\Menu\Filters\SubmenuFilter::class,
        JeroenNoten\LaravelAdminLte\Menu\Filters\ClassesFilter::class,
        JeroenNoten\LaravelAdminLte\Menu\Filters\GateFilter::class,
    ],

    /*
    |--------------------------------------------------------------------------
    | Plugins Initialization
    |--------------------------------------------------------------------------
    |
    | Choose which JavaScript plugins should be included. At this moment,
    | only DataTables is supported as a plugin. Set the value to true
    | to include the JavaScript file from a CDN via a script tag.
    |
    */

    'plugins' => [
        'datatables' => true,
        'select2' => true,
        'chartjs' => true,
    ],
];
