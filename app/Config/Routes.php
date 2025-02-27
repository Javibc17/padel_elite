<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */
$routes->get('/', 'Home::index');


//Usuarios
$routes->get('users', 'UserController::index');
$routes->get('users/save', 'UserController::SaveUser');
$routes->get('users/save/(:num)', 'UserController::SaveUser/$1');
$routes->post('users/save', 'UserController::SaveUser');
$routes->post('users/save/(:num)', 'UserController::SaveUser/$1');
$routes->get('users/delete/(:num)', 'UserController::delete/$1');



//Roles
$routes->get('roles', 'RoleController::index');



//Reservas
$routes->get('reservas', 'ReservaController::index');



//Clases
$routes->get('clases', 'ClaseController::index');



//Clases Usuario
$routes->get('clasesUsuario', 'ClasesUsuarioController::index');



//Pistas
$routes->get('pistas', 'PistaController::index');




$routes->get('calendar', 'EventController::index');
$routes->get('signIn', 'SigninController::index');
$routes->get('signUp', 'SignUpController::index');
$routes->post('signUp/store', 'SignUpController::store');



$routes->get('/fetch-events', 'EventController::fetchEvents');
$routes->post('/add-event', 'EventController::addEvent');
$routes->delete('/delete-event/(:num)', 'EventController::deleteEvent/$1');