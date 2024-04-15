<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */

$routes->options('(:any)', '', ['filter' => 'cors']);

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
$routes->post('users/register', 'UserController::register');
$routes->post('users/login', 'UserController::login');

// PROVIDERS
$routes->get('providers', 'ProviderController::index');
$routes->get('providers/(:num)', 'ProviderController::show/$1');
$routes->post('providers', 'ProviderController::create');
$routes->put('providers/(:num)', 'ProviderController::update/$1');
$routes->delete('providers/(:num)', 'ProviderController::delete/$1');

// RECIPES
$routes->get('recipes', 'RecipeController::index');
$routes->get('recipes/(:num)', 'RecipeController::show/$1');
$routes->post('recipes', 'RecipeController::create');
$routes->put('recipes/(:num)', 'RecipeController::update/$1');
$routes->delete('recipes/(:num)', 'RecipeController::delete/$1');

// MENUS
$routes->get('menus', 'MenuController::index');
$routes->get('menus/(:num)', 'MenuController::show/$1');
$routes->post('menus', 'MenuController::create');
$routes->put('menus/(:num)', 'MenuController::update/$1');
$routes->delete('menus/(:num)', 'MenuController::delete/$1');
