<?php

use CodeIgniter\Router\RouteCollection;

/** @var RouteCollection $routes */
$routes->get('/', 'Auth::index');
$routes->get('auth/login', 'Auth::index');
$routes->post('auth/login', 'Auth::login');
$routes->get('logout', 'Auth::logout');
$routes->get('dashboard', 'Dashboard::index');
