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
$routes->get('/suplai', 'Suplai::index');
$routes->get('/profile', 'Profile::index');
$routes->get('/lokasi', 'Lokasi::index');