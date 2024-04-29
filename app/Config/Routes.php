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

//COMANDA
$routes->get('order', 'OrderController::index');
$routes->get('order/(:num)', 'OrderController::show/$1');
$routes->post('order', 'OrderController::create');
$routes->put('order/(:num)', 'OrderController::update/$1');
$routes->delete('order/(:num)', 'OrderController::delete/$1');


// USERS
$routes->post('register', 'UserController::register');
$routes->post('login', 'UserController::login');

// PRODUCTS
$routes->get('products', 'ProductsController::index');
$routes->get('products/(:num)', 'ProductsController::show/$1');
$routes->post('products', 'ProductsController::create');
$routes->put('products/(:num)', 'ProductsController::update/$1');
$routes->delete('products/(:num)', 'ProductsController::delete/$1');



// PRODUCTS*PROVIDERS
$routes->get('product-provider', 'ProductsProviderController::index');
$routes->get('product-provider/(:num)', 'ProductsProviderController::show/$1');
$routes->post('product-provider', 'ProductsProviderController::create');
$routes->put('product-provider/(:num)', 'ProductsProviderController::update/$1');
$routes->delete('product-provider/(:num)', 'ProductsProviderController::delete/$1');



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

// PRICES
$routes->get('prices', 'PriceController::index');
$routes->get('prices/(:num)', 'PriceController::show/$1');
$routes->post('prices', 'PriceController::create');
$routes->put('prices/(:num)', 'PriceController::update/$1');
$routes->delete('prices/(:num)', 'PriceController::delete/$1');

// ALLERGEN
$routes->get('allergens', 'AllergenController::index');
$routes->get('allergens/(:num)', 'AllergenController::show/$1');
$routes->post('allergens', 'AllergenController::create');
$routes->put('allergens/(:num)', 'AllergenController::update/$1');
$routes->delete('allergens/(:num)', 'AllergenController::delete/$1');