<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */


$routes->get('/', 'Dashboard::index');
$routes->get('/dashboard', 'Dashboard::index');
$routes->get('/pengguna', 'Pengguna::index');
$routes->get('/produk', 'Produk::index');
$routes->get('/pesanan', 'Pesanan::index');
$routes->get('/penjualan', 'Penjualan::index');