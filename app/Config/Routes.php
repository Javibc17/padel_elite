<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */
$routes->get('/', 'AuthController::login'); // Cambiar la ruta principal al login

// Home
$routes->get('home', 'Home::index'); // Ruta para Home::index

// Usuarios
$routes->get('users', 'UserController::index');
$routes->get('users/create', 'UserController::create');
$routes->post('users/store', 'UserController::store');
$routes->get('users/edit/(:num)', 'UserController::edit/$1');
$routes->post('users/update/(:num)', 'UserController::update/$1');
$routes->get('users/deactivate/(:num)', 'UserController::deactivate/$1');
$routes->get('users/activate/(:num)', 'UserController::activate/$1');

$routes->get('users/export', 'UserController::exportToCSV');

// Roles
$routes->get('roles', 'RoleController::index');

// Reservas
$routes->get('reservas', 'ReservaController::index');

// Clases
$routes->get('clases', 'ClaseController::index');

// Clases Usuario
$routes->get('clasesUsuario', 'ClasesUsuarioController::index');

// Pistas
$routes->get('pistas', 'PistaController::index');

$routes->get('calendar', 'EventController::index');

$routes->get('register', 'AuthController::register');
$routes->post('auth/processRegister', 'AuthController::processRegister');
$routes->get('login', 'AuthController::login');
$routes->post('auth/processLogin', 'AuthController::processLogin');
$routes->get('logout', 'AuthController::logout');

$routes->get('/fetch-events', 'EventController::fetchEvents');
$routes->post('/add-event', 'EventController::addEvent');
$routes->delete('/delete-event/(:num)', 'EventController::deleteEvent/$1');