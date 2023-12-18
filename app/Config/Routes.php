<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */
$routes->setAutoRoute(true);
$routes->get('/', 'Home::index');
$routes->get('/backend/payment-channel', 'Backend\Channel::index');
$routes->get('/backend/logout', 'Backend\Login::logout');

$routes->set404Override(function($message = null) {
    $data['message'] = $message;
    echo view('errors/custom/error_404', $data);
});
