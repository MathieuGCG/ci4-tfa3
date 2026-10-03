<?php

use CodeIgniter\Router\RouteCollection;

/** @var RouteCollection $routes */
$routes->get('/', 'Pages::index');
$routes->get('about', 'Pages::about');

// Customer Routes
$routes->get('customers', 'CustomerController::index');
$routes->get('customers/new', 'CustomerController::new');
$routes->post('customers/create', 'CustomerController::create');
$routes->get('customers/edit/(:num)', 'CustomerController::edit/$1');
$routes->post('customers/update/(:num)', 'CustomerController::update/$1');

// User Routes
$routes->get('users', 'UserController::index');
$routes->get('users/new', 'UserController::new');
$routes->post('users/create', 'UserController::create');
$routes->get('users/edit/(:num)', 'UserController::edit/$1');
$routes->post('users/update/(:num)', 'UserController::update/$1');