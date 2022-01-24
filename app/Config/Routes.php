<?php

namespace Config;

// Create a new instance of our RouteCollection class.
$routes = Services::routes();

// Load the system's routing file first, so that the app and ENVIRONMENT
// can override as needed.
if (file_exists(SYSTEMPATH . 'Config/Routes.php')) {
    require SYSTEMPATH . 'Config/Routes.php';
}

/*
 * --------------------------------------------------------------------
 * Router Setup
 * --------------------------------------------------------------------
 */
$routes->setDefaultNamespace('App\Controllers\Portal');
$routes->setDefaultController('HomeController');
$routes->setDefaultMethod('index');
$routes->setTranslateURIDashes(false);
$routes->set404Override();
$routes->setAutoRoute(false);

/*
 * --------------------------------------------------------------------
 * Route Definitions
 * --------------------------------------------------------------------
 */

// We get a performance increase by specifying the default
// route since we don't have to scan directories.
$routes->get('/', 'HomeController::index');
$routes->group('admin',['namespace' => 'App\Controllers\Admin'], function ($routes) {
    $routes->get('/', 'HomeController::index');
    
    //$routes->resource('user');
    $routes->get('user', 'UserController::index');
    $routes->get('user/new', 'UserController::new');
    $routes->get('user/(:num)', 'UserController::show/$1');
    $routes->get('user/show/(:num)', 'UserController::show/$1');
    $routes->get('user/edit/(:num)', 'UserController::edit/$1');
    $routes->get('user/remove/(:num)', 'UserController::delete/$1');
    $routes->put('user/edit/(:num)', 'UserController::update/$1');
    $routes->post('user', 'UserController::create');
});

/*
 * --------------------------------------------------------------------
 * Additional Routing
 * --------------------------------------------------------------------
 *
 * There will often be times that you need additional routing and you
 * need it to be able to override any defaults in this file. Environment
 * based routes is one such time. require() additional route files here
 * to make that happen.
 *
 * You will have access to the $routes object within that file without
 * needing to reload it.
 */
if (file_exists(APPPATH . 'Config/' . ENVIRONMENT . '/Routes.php')) {
    require APPPATH . 'Config/' . ENVIRONMENT . '/Routes.php';
}

/* Sample Routes Output
$ php spark routes (presenter)

+--------+----------------------------+------------------------------------------------+
| Method | Route                      | Handler                                        |
+--------+----------------------------+------------------------------------------------+
| GET    | /                          | \App\Controllers\Portal\HomeController::index  |
| GET    | admin                      | \App\Controllers\Admin\HomeController::index   |
| GET    | admin/user                 | \App\Controllers\Admin\User::index             |
| GET    | admin/user/show/(.*)       | \App\Controllers\Admin\User::show/$1           |
| GET    | admin/user/new             | \App\Controllers\Admin\User::new               |
| GET    | admin/user/edit/(.*)       | \App\Controllers\Admin\User::edit/$1           |
| GET    | admin/user/remove/(.*)     | \App\Controllers\Admin\User::remove/$1         |
| GET    | admin/user/(.*)            | \App\Controllers\Admin\User::show/$1           |
| POST   | admin/user/create          | \App\Controllers\Admin\User::create            |
| POST   | admin/user/update/(.*)     | \App\Controllers\Admin\User::update/$1         |
| POST   | admin/user/delete/(.*)     | \App\Controllers\Admin\User::delete/$1         |
| POST   | admin/user                 | \App\Controllers\Admin\User::create            |
+--------+----------------------------+------------------------------------------------+

$ php spark routes (resource)

+--------+----------------------------+------------------------------------------------+
| Method | Route                      | Handler                                        |
+--------+----------------------------+------------------------------------------------+
| GET    | /                          | \App\Controllers\Portal\HomeController::index  |
| GET    | admin                      | \App\Controllers\Admin\HomeController::index   |
| GET    | admin/user                 | \App\Controllers\Admin\User::index             |
| GET    | admin/user/new             | \App\Controllers\Admin\User::new               |
| GET    | admin/user/(.*)/edit       | \App\Controllers\Admin\User::edit/$1           |
| GET    | admin/user/(.*)            | \App\Controllers\Admin\User::show/$1           |
| POST   | admin/user                 | \App\Controllers\Admin\User::create            |
| PATCH  | admin/user/(.*)            | \App\Controllers\Admin\User::update/$1         |
| PUT    | admin/user/(.*)            | \App\Controllers\Admin\User::update/$1         |
| DELETE | admin/user/(.*)            | \App\Controllers\Admin\User::delete/$1         |
+--------+----------------------------+------------------------------------------------+
*/