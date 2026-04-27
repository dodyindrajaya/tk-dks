<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */
//$routes->get('/', 'Home::index');
$routes->get('/', 'AuthController::index');
$routes->get('/login', 'AuthController::index');
$routes->post('/login/process', 'AuthController::login');
$routes->get('/logout', 'AuthController::logout');

// Grouping routes yang butuh login
$routes->group('', ['filter' => 'auth'], function($routes) {
    $routes->get('/dashboard', 'Dashboard::index');
    $routes->get('/siswa', 'Siswa::index');
    // Tambahkan route menu lainnya di sini
});
$routes->get('/setup-admin', 'AuthController::setupAdmin');
$routes->group('', ['filter' => 'auth'], function($routes) {
    $routes->get('/dashboard', 'Dashboard::index');
    
    // Route untuk Tahun Ajaran
    $routes->get('/ta', 'TahunAjaran::index');
    $routes->post('/ta/save', 'TahunAjaran::save');
    $routes->post('/ta/update/(:num)', 'TahunAjaran::update/$1'); // Route Update
    $routes->get('/ta/delete/(:num)', 'TahunAjaran::delete/$1');  // Route Delete
});
$routes->get('/anggaran', 'Anggaran::index');
$routes->post('/anggaran/save', 'Anggaran::save');
$routes->get('/anggaran/detail/(:num)', 'Anggaran::detail/$1');
$routes->post('/anggaran/save_detail/(:num)', 'Anggaran::save_detail/$1');
$routes->get('/anggaran/delete_detail/(:num)/(:num)', 'Anggaran::delete_detail/$1/$2');

$routes->get('/realisasi', 'Realisasi::index');
$routes->post('/realisasi/save', 'Realisasi::save');
$routes->get('/realisasi/detail/(:num)', 'Realisasi::detail/$1');
$routes->post('/realisasi/save_detail/(:num)', 'Realisasi::save_detail/$1');
$routes->get('/realisasi/delete_detail/(:num)/(:num)', 'Realisasi::delete_detail/$1/$2');

$routes->get('/siswa', 'Siswa::index');
$routes->post('/siswa/save', 'Siswa::save');
$routes->get('/siswa/delete/(:num)', 'Siswa::delete/$1');

$routes->get('/laporan', 'Laporan::index');