<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */
$routes->get('/', 'Home::index');

// CENTRES
$routes->get('centres', 'CentresController::index');
$routes->get('centres/(:num)', 'CentresController::show/$1');
$routes->post('centres', 'CentresController::create');
$routes->put('centres/(:num)', 'CentresController::update/$1');
$routes->delete('centres/(:num)', 'CentresController::delete/$1');

// USERS
$routes->post('register', 'UserController::register');
$routes->post('login', 'UserController::login');
