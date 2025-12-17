<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */
$routes->get('/', 'Home::index');

// cli
$routes->get('/export_shp', 'ExportShp::index');
$routes->get('/export_shp_custom', 'ExportShp::custom');

$routes->get('/importproject', 'ImportProject::index');