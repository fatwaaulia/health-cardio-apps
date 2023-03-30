<?php

namespace Config;

// Create a new instance of our RouteCollection class.
$routes = Services::routes();

/*
 * --------------------------------------------------------------------
 * Router Setup
 * --------------------------------------------------------------------
 */
$routes->setDefaultNamespace('App\Controllers');
$routes->setDefaultController('Home');
$routes->setDefaultMethod('index');
$routes->setTranslateURIDashes(false);
$routes->set404Override(
    function(){
        $data['title'] = '404';
        $data['content'] = view('errors/e404');
        return view('dashboard/header',$data);
    }
);
// The Auto Routing (Legacy) is very dangerous. It is easy to create vulnerable apps
// where controller filters or CSRF protection are bypassed.
// If you don't want to define all routes, please use the Auto Routing (Improved).
// Set `$autoRoutesImproved` to true in `app/Config/Feature.php` and set the following to true.
// $routes->setAutoRoute(false);

/*
 * --------------------------------------------------------------------
 * Route Definitions
 * --------------------------------------------------------------------
 */

// We get a performance increase by specifying the default
// route since we don't have to scan directories.
$routes->get('/', 'C_Auth::login');

// AUTENTIKASI
// Login
$routes->get('login', 'C_Auth::login');
$routes->post('login-process', 'C_Auth::loginProcess');
$routes->get('logout', 'C_Auth::logout');
// Register
$routes->get('register', 'C_Auth::register');
$routes->post('register-process', 'C_Auth::registerProcess');

// IS LOGIN
$routes->get('dashboard', 'C_Dashboard::dashboard', ['filter' => 'Auth']);

// PROFILE
$routes->group('profile', ['filter' => 'Auth'], static function ($routes) {
$routes->get('/', 'C_Users::profile');
$routes->post('update', 'C_Users::updateProfile');
});

// SETTING
$routes->group('settings', ['filter' => 'Auth'], static function ($routes) {
$routes->get('/', 'C_Users::settings');
$routes->post('update/password', 'C_Users::updatePassword');
});

// SUPERADMIN
// User
$routes->group('users', ['filter' => 'Superadmin'], static function ($routes) {
    $routes->get('/', 'C_Users::index');
    $routes->get('edit/(:segment)', 'C_Users::edit/$1');
    $routes->post('update/(:segment)', 'C_Users::update/$1');
    $routes->post('delete/(:segment)', 'C_Users::delete/$1');
    $routes->post('delete-image/(:segment)', 'C_Users::deleteImg/$1');
});
// Form Input
$routes->group('form-input', ['filter' => 'Superadmin'], static function ($routes) {
    $routes->get('/', 'C_FormInput::index');
    $routes->get('new', 'C_FormInput::new');
    $routes->post('create', 'C_FormInput::create');
    $routes->get('edit/(:segment)', 'C_FormInput::edit/$1');
    $routes->post('update/(:segment)', 'C_FormInput::update/$1');
    $routes->post('delete/(:segment)', 'C_FormInput::delete/$1');
    $routes->post('delete-image/(:segment)', 'C_FormInput::deleteImg/$1');
});

// PASIEN
// Screening
$routes->group('screening', ['filter' => 'Pasien'], static function ($routes) {
    $routes->get('/', 'C_Screening::screening');
    $routes->get('new', 'C_Screening::new');
    $routes->post('create', 'C_Screening::create');
    $routes->get('edit/(:segment)', 'C_Screening::edit/$1');
    $routes->post('update/(:segment)', 'C_Screening::update/$1');
    $routes->post('delete/(:segment)', 'C_Screening::delete/$1');
    $routes->post('delete-image/(:segment)', 'C_Screening::deleteImg/$1');
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
if (is_file(APPPATH . 'Config/' . ENVIRONMENT . '/Routes.php')) {
    require APPPATH . 'Config/' . ENVIRONMENT . '/Routes.php';
}
