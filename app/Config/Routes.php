<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */
$routes->setAutoRoute(true);
$routes->get('/', 'Home::index');
$routes->get('', 'Home::index');
$routes->get('/home', 'Home::index');
#service('auth')->routes();
service('auth')->routes($routes);

$routes->get('login', 'LoginController::loginView');
$routes->get('admin', 'Admin::index');
$routes->get('annoucements', 'Announcements::index');
$routes->get('offline', 'Offline::index');
$routes->get('logout', 'LoginController::logout_action');
$routes->get('register', 'RegisterController::registerView');
$routes->get('api/info', 'Home::getIndex');
$routes->get('api/syllabus', 'Syllabus::getIndex');
$routes->get('api/announcements', 'Announcements::getIndex');


