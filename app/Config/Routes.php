<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */

$routes->get('/', 'Login::index');
$routes->post('/login', 'Login::login_action');
$routes->get('/logout', 'Login::logout');

$routes->get('/admin', 'Admin::index', ['filter' => 'AdminFilter']);

$routes->get('/admin/perusahaan', 'Admin\Perusahaan::index', ['filter' => 'AdminFilter']);
$routes->get('/admin/perusahaan/create', 'Admin\Perusahaan::create', ['filter' => 'AdminFilter']);
$routes->post('/admin/perusahaan/store', 'Admin\Perusahaan::store', ['filter' => 'AdminFilter']);
$routes->get('/admin/perusahaan/edit/(:segment)', 'Admin\Perusahaan::edit/$1', ['filter' => 'AdminFilter']);
$routes->post('/admin/perusahaan/update/(:segment)', 'Admin\Perusahaan::update/$1', ['filter' => 'AdminFilter']);
$routes->get('/admin/perusahaan/destroy/(:segment)', 'Admin\Perusahaan::destroy/$1', ['filter' => 'AdminFilter']);

$routes->get('/admin/purchasing', 'Admin\Purchasing::index', ['filter' => 'AdminFilter']);
$routes->get('/admin/purchasing/create', 'Admin\Purchasing::create', ['filter' => 'AdminFilter']);
$routes->post('/admin/purchasing/store', 'Admin\Purchasing::store', ['filter' => 'AdminFilter']);
$routes->get('/admin/purchasing/edit/(:segment)', 'Admin\Purchasing::edit/$1', ['filter' => 'AdminFilter']);
$routes->post('/admin/purchasing/update/(:segment)', 'Admin\Purchasing::update/$1', ['filter' => 'AdminFilter']);
$routes->get('/admin/purchasing/destroy/(:segment)', 'Admin\Purchasing::destroy/$1', ['filter' => 'AdminFilter']);

$routes->get('/admin/data_admin', 'Admin\DataAdmin::index', ['filter' => 'AdminFilter']);
$routes->get('/admin/data_admin/create', 'Admin\DataAdmin::create', ['filter' => 'AdminFilter']);
$routes->post('/admin/data_admin/store', 'Admin\DataAdmin::store', ['filter' => 'AdminFilter']);
$routes->get('/admin/data_admin/edit/(:segment)', 'Admin\DataAdmin::edit/$1', ['filter' => 'AdminFilter']);
$routes->post('/admin/data_admin/update/(:segment)', 'Admin\DataAdmin::update/$1', ['filter' => 'AdminFilter']);
$routes->get('/admin/data_admin/destroy/(:segment)', 'Admin\DataAdmin::destroy/$1', ['filter' => 'AdminFilter']);

$routes->get('/admin/produk', 'Admin\Produk::index', ['filter' => 'AdminFilter']);
$routes->get('/admin/produk/create', 'Admin\Produk::create', ['filter' => 'AdminFilter']);
$routes->post('/admin/produk/store', 'Admin\Produk::store', ['filter' => 'AdminFilter']);
$routes->get('/admin/produk/edit/(:segment)', 'Admin\Produk::edit/$1', ['filter' => 'AdminFilter']);
$routes->post('/admin/produk/update/(:segment)', 'Admin\Produk::update/$1', ['filter' => 'AdminFilter']);
$routes->get('/admin/produk/destroy/(:segment)', 'Admin\Produk::destroy/$1', ['filter' => 'AdminFilter']);

$routes->get('/admin/transaksi', 'Admin\Transaksi::index', ['filter' => 'AdminFilter']);
$routes->get('/admin/transaksi/create', 'Admin\Transaksi::create', ['filter' => 'AdminFilter']);
$routes->post('/admin/transaksi/store', 'Admin\Transaksi::store', ['filter' => 'AdminFilter']);
$routes->get('/admin/transaksi/detail/(:segment)', 'Admin\Transaksi::detail/$1', ['filter' => 'AdminFilter']);