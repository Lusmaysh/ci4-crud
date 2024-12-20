<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */
$routes->add('/', 'Buku::index');
$routes->add('/buku', 'Buku::index');

$routes->get('/buku/tambah', 'Buku::tambah');
$routes->get('buku/ubah/(:num)', 'Buku::ubah/$1');
$routes->post('/buku/update/(:num)', 'Buku::update/$1');
$routes->delete('/buku/(:num)', 'Buku::hapus/$1');
$routes->post('/buku/simpan', 'Buku::simpan');
$routes->get('/buku/(:any)', 'Buku::detail/$1');

$routes->get(from: '/anggota', to: 'anggota::index');
$routes->post(from: '/anggota', to: 'anggota::index');

// $routes->add(from: '/anggota', to: 'anggota::index');
