<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */
$routes->get('/', 'Home::index');
$routes->get('/payments', 'Payments::index');
$routes->post('/payments', 'Payments::process');
