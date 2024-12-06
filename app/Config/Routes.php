<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */
$routes->get('/', 'Buku::index');
$routes->get('/buku', 'Buku::index');

$routes->get('/buku/tambah', 'Buku::tambah');
$routes->get('buku/ubah/(:num)', 'Buku::ubah/$1');
$routes->post('/buku/update/(:num)', 'Buku::update/$1');
$routes->delete('/buku/(:num)', 'Buku::hapus/$1');
$routes->post('/buku/simpan', 'Buku::simpan');
$routes->get('/buku/(:any)', 'Buku::detail/$1');