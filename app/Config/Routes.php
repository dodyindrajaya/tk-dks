<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */
$routes->get('/', 'Home::index');
$routes->get('/login', 'AuthController::index');
$routes->post('/login/process', 'AuthController::login');
$routes->get('/logout', 'AuthController::logout');

// Grouping routes yang butuh login
$routes->group('', ['filter' => 'auth'], function($routes) {
    $routes->get('/dashboard', 'Dashboard::index');
    $routes->get('/siswa', 'Siswa::index');
    // Tambahkan route menu lainnya di sini
});