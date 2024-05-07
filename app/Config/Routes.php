<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */
$routes->setAutoRoute(true);
$routes->get('/', 'Home::index');
$routes->get('/home', 'Home::index');
#service('auth')->routes();
service('auth')->routes($routes);

$routes->get('login', 'LoginController::loginView');
$routes->get('logout', 'LoginController::logout_action');
$routes->get('register', 'RegisterController::registerView');

