<?php

use CodeIgniter\Router\RouteCollection;

/** @var RouteCollection $routes */

// Home page shows the student list.
$routes->get('/', 'Students::index');

// Student CRUD routes.
// Specific paths like "students/create" come before "students/(:num)"
// so the router never confuses them.
$routes->get('students', 'Students::index');
$routes->get('students/create', 'Students::create');
$routes->post('students', 'Students::store');
$routes->get('students/(:num)', 'Students::show/$1');
$routes->get('students/(:num)/edit', 'Students::edit/$1');
$routes->post('students/(:num)', 'Students::update/$1');
$routes->post('students/(:num)/delete', 'Students::delete/$1');
