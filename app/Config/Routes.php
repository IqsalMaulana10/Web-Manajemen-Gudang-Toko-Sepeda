<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */

// Route Autentikasi
$routes->get('/login', 'Auth::index');
$routes->post('/auth/login', 'Auth::login');
$routes->get('/logout', 'Auth::logout');

// Route Dashboard Utama (Produk)
$routes->get('/', 'Produk::index');
$routes->get('/produk', 'Produk::index');
$routes->post('/produk/simpan', 'Produk::save');
$routes->post('/produk/update', 'Produk::update');

// Route Hapus menggunakan (:any) karena kode_sepeda adalah String
$routes->get('/produk/hapus/(:any)', 'Produk::delete/$1');

// Route Laporan & Rekap Mutasi
$routes->post('/produk/laporan', 'Produk::laporan');
$routes->get('/produk/rekap', 'Produk::rekap');

// Route Manajemen Kategori
$routes->post('/kategori/simpan', 'Produk::saveKategori');