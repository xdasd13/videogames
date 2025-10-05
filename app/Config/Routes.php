<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */
$routes->setDefaultController('HomeController');
$routes->setDefaultMethod('index');

// Rutas de autenticación
$routes->get('login', 'AuthController::login');
$routes->post('auth', 'AuthController::auth');
$routes->get('logout', 'AuthController::logout');

// Rutas de registro
$routes->get('register', 'RegisterController::index');
$routes->post('register/create', 'RegisterController::create');

// Rutas protegidas que requieren autenticación
$routes->group('', ['filter' => 'auth'], function($routes) {
    // Ruta de inicio
    $routes->get('/', 'HomeController::index');
    $routes->get('home', 'HomeController::index');

    // Rutas de perfil
    $routes->get('profile', 'HomeController::profile');
    $routes->post('profile/update-avatar', 'HomeController::updateAvatar');

    // Rutas de administrador
    $routes->get('users', 'HomeController::userList');
});
