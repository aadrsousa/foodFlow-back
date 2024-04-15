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

// PRODUCTES
$routes->get('productes', 'ProductesController::index');
$routes->get('productes/(:num)', 'ProductesController::show/$1');
$routes->post('productes', 'ProductesController::create');
$routes->put('productes/(:num)', 'ProductesController::update/$1');
$routes->delete('productes/(:num)', 'ProductesController::delete/$1');

// PROVEIDORS
$routes->get('proveidors', 'ProveidorsController::index');
$routes->get('proveidors/(:num)', 'ProveidorsController::show/$1');
$routes->post('proveidors', 'ProveidorsController::create');
$routes->put('proveidors/(:num)', 'ProveidorsController::update/$1');
$routes->delete('proveidors/(:num)', 'ProveidorsController::delete/$1');

// PRODUCTES*PROVEIDORS

$routes->get('producte-proveidor', 'ProducteProveidorController::index');
$routes->get('producte-proveidor/(:num)', 'ProducteProveidorController::show/$1');
$routes->post('producte-proveidor', 'ProducteProveidorController::create');
$routes->put('producte-proveidor/(:num)', 'ProducteProveidorController::update/$1');
$routes->delete('producte-proveidor/(:num)', 'ProducteProveidorController::delete/$1');
