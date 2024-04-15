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