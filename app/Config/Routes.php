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
$routes->setDefaultNamespace('App\Controllers');
$routes->setDefaultController('Login');
$routes->setDefaultMethod('index');
$routes->setTranslateURIDashes(false);
$routes->set404Override();
$routes->setAutoRoute(true);

/*
 * --------------------------------------------------------------------
 * Route Definitions
 * --------------------------------------------------------------------
 */

// We get a performance increase by specifying the default
// route since we don't have to scan directories.
$routes->get('a', 'Home::index');
$routes->get('auth', 'Login::login', ['filter' => 'auth']);
$routes->get('datagadai', 'Pegadaian::index', ['filter' => 'auth']);
$routes->get('listgadai', 'Pegadaian::list', ['filter' => 'auth']);
$routes->get('listlelang', 'Pegadaian::list', ['filter' => 'auth']);
$routes->get('listLaporan', 'Pegadaian::list_laporan', ['filter' => 'auth']);
$routes->get('formgadai', 'Pegadaian::create', ['filter' => 'auth']);
$routes->post('importdata', 'Pegadaian::import', ['filter' => 'auth']);

$routes->get('datanasabah', 'Nasabah::index', ['filter' => 'auth']);
$routes->get('formnasabah', 'Nasabah::create', ['filter' => 'auth']);

$routes->get('datauser', 'User::index', ['filter' => 'auth']);
$routes->get('formuser', 'User::create', ['filter' => 'auth']);

$routes->get('datalaporan', 'Laporan::index', ['filter' => 'auth']);
$routes->get('laporanakanlelang', 'Laporan::AkanLelang', ['filter' => 'auth']);
$routes->get('laporanterlelang', 'Laporan::Terlelang', ['filter' => 'auth']);
$routes->get('laporanlunas', 'Laporan::Lunas', ['filter' => 'auth']);
$routes->get('formlaporan', 'Laporan::create', ['filter' => 'auth']);
$routes->get('uploadForm', 'Laporan::uploadForm', ['filter' => 'auth']);

$routes->get('datacabang', 'Cabang::index', ['filter' => 'auth']);
$routes->get('formcabang', 'Cabang::create', ['filter' => 'auth']);

$routes->get('dataaturan', 'Aturan::index', ['filter' => 'auth']);
$routes->get('formaturan', 'Aturan::create', ['filter' => 'auth']);

$routes->get('databarang', 'Barang::index', ['filter' => 'auth']);
$routes->get('formbarang', 'Barang::create', ['filter' => 'auth']);

$routes->get('terlelang', 'Pegadaian::TerLelang', ['filter' => 'auth']);
$routes->get('datalelang', 'Pegadaian::AkanLelang', ['filter' => 'auth']);

$routes->get('saldo', 'Saldo::index', ['filter' => 'auth']);

$routes->get('homepage', 'Dashboard::index', ['filter' => 'auth']);

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