<?php

namespace Config;

// Create a new instance of our RouteCollection class.
$routes = Services::routes();

// Load the system's routing file first, so that the app and ENVIRONMENT
// can override as needed.
if (is_file(SYSTEMPATH . 'Config/Routes.php')) {
    require SYSTEMPATH . 'Config/Routes.php';
}

/*
 * --------------------------------------------------------------------
 * Router Setup
 * --------------------------------------------------------------------
 */
$routes->setDefaultNamespace('App\Controllers');
$routes->setDefaultController('Home');
$routes->setDefaultMethod('index');
$routes->setTranslateURIDashes(true);
$routes->set404Override();
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
$routes->get('/', 'DashboardController::index', ['filter'=>'auth']);
$routes->get('login', 'Login::index', ['filter'=>'ifauth']);
$routes->post('login', 'Login::submit', ['filter'=>'ifauth']);
$routes->get('logout', 'DashboardController::logout', ['filter'=>'auth']);

$routes->group('', ['filter'=>'auth'],function($routes){
    $routes->get('dashboard', 'DashboardController::index');
    
    $routes->get('master/barang', 'BarangController::index');
    $routes->post('master/barang/list', 'BarangController::list');
    $routes->post('master/barang/create', 'BarangController::submit');
    $routes->post('master/barang/delete', 'BarangController::delete');
    $routes->post('master/barang/update', 'BarangController::submit');
    
    $routes->get('master/jenis-barang', 'JenisController::index');
    $routes->post('master/jenis-barang/list', 'JenisController::list');
    $routes->post('master/jenis-barang/create', 'JenisController::submit');
    $routes->post('master/jenis-barang/delete', 'JenisController::delete');
    $routes->post('master/jenis-barang/update', 'JenisController::submit');
    
    $routes->get('master/pemasok', 'PemasokController::index');
    $routes->post('master/pemasok/list', 'PemasokController::list');
    $routes->post('master/pemasok/create', 'PemasokController::submit');
    $routes->post('master/pemasok/delete', 'PemasokController::delete');
    $routes->post('master/pemasok/update', 'PemasokController::submit');
    
    $routes->get('master/pengguna', 'PenggunaController::index');
    $routes->post('master/pengguna/list', 'PenggunaController::list');
    $routes->post('master/pengguna/create', 'PenggunaController::submit');
    $routes->post('master/pengguna/delete', 'PenggunaController::delete');
    $routes->post('master/pengguna/update', 'PenggunaController::submit');
    
    $routes->get('master/satuan-barang', 'SatuanController::index');
    $routes->post('master/satuan-barang/list', 'SatuanController::list');
    $routes->post('master/satuan-barang/create', 'SatuanController::submit');
    $routes->post('master/satuan-barang/delete', 'SatuanController::delete');
    $routes->post('master/satuan-barang/update', 'SatuanController::submit');
    
    $routes->get('barang-masuk', 'EntranceController::index');
    $routes->get('barang-masuk/baru', 'EntranceController::add');
    $routes->get('barang-masuk/detail/(:num)', 'EntranceController::detail/$1');
    $routes->post('barang-masuk/list-detail', 'EntranceController::listDetail');
    $routes->post('barang-masuk/list', 'EntranceController::list');
    $routes->post('barang-masuk/create', 'EntranceController::submit');
    $routes->post('barang-masuk/delete', 'EntranceController::delete');
    $routes->post('barang-masuk/update', 'EntranceController::submit');
    
    $routes->get('barang-keluar', 'OutgoingController::index');
    $routes->get('barang-keluar/baru', 'OutgoingController::add');
    $routes->get('barang-keluar/detail/(:num)', 'OutgoingController::detail/$1');
    $routes->post('barang-keluar/list-detail/', 'OutgoingController::listDetail');
    $routes->post('barang-keluar/list', 'OutgoingController::list');
    $routes->post('barang-keluar/create', 'OutgoingController::submit');
    $routes->post('barang-keluar/delete', 'OutgoingController::delete');
    $routes->post('master/barang-keluar/update', 'OutgoingController::submit');
    
    $routes->get('laporan/barang-masuk', 'ReportController::entrance');
    $routes->post('laporan/barang-masuk/list', 'ReportController::;listEntrance');
    
    $routes->get('laporan/barang-keluar', 'ReportController::outgoing');
    $routes->post('laporan/barang-keluar/list', 'ReportController::listOugoing');
    
    $routes->get('laporan/stok', 'ReportController::stock');
    $routes->post('laporan/list-stok/', 'ReportController::listStock');
    
    $routes->get('cetak/barang-masuk', 'PrintController::entrance');
    $routes->post('cetak/barang-masuk/list', 'PrintController::listEntrance');
    
    $routes->get('cetak/barang-keluar', 'PrintController::outgoing');
    $routes->post('cetak/barang-keluar/list', 'PrintController::listOutgoing');
    
    $routes->get('cetak/stok', 'PrintController::stock');
    $routes->post('cetak/list-stok', 'PrintController::listStock');
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
