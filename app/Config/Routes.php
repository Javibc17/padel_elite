<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */
$routes->get('/', 'Home::index');
$routes->get('users', 'UserController::index');
$routes->get('roles', 'RoleController::index');
$routes->get('reservas', 'ReservaController::index');
$routes->get('clases', 'ClaseController::index');
$routes->get('clasesUsuario', 'ClasesUsuarioController::index');
$routes->get('pistas', 'PistaController::index');
$routes->get('calendar', 'calendarController::index');
$routes->get('signIn', 'SigninController::index');
$routes->get('signUp', 'SignUpController::index');
$routes->post('signUp/store', 'SignUpController::store');



