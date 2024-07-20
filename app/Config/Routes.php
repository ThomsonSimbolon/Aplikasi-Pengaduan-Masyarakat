<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */
$routes->get('create-db', function () {
    $forge = \Config\Database::forge();
    if ($forge->createDatabase('apk_pengaduan')) {
        echo 'Database created!';
    }
});

$routes->get('/', 'Auth::index');

// Routes Auth Login
$routes->get('auth/formLogin', 'Auth::formLogin');
$routes->get('auth/berita', 'Auth::berita');
$routes->post('auth/login', 'Auth::login/$1');
$routes->get('auth/register', 'Auth::register');
$routes->post('auth/register', 'Auth::register');
$routes->get('auth/logout', 'Auth::logout');
$routes->post('auth/logout', 'Auth::logout');
$routes->setDefaultController('Auth');
$routes->setDefaultMethod('index');

// Routes untuk mengakses controller admin beserta method yang digunakan
$routes->group('admin', ['namespace' => 'App\Controllers\Admin'], function ($routes) {

    // Routes untuk mengakses controller admin beserta method yang digunukan untuk menampilkan halaman home
    $routes->get('home', 'HomeController::index');
    $routes->get('home/masyarakat/(:num)', 'HomeController::masyarakat/$1');
    $routes->get('home/masyarakat/edit/(:segment)', 'HomeController::edit/$1');
    $routes->post('home/masyarakat/update/(:segment)', 'HomeController::update/$1');

    // Routes untuk mengakses controller admin beserta method yang digunukan untuk menampilkan halaman profile
    $routes->get('profile', 'ProfileController::index');
    $routes->get('profile/update/(:num)', 'ProfileController::update/$1');

    // Routes untuk mengakses controller admin beserta method yang digunukan untuk menampilkan halaman keluhan
    $routes->get('keluhan', 'KeluhanController::index');
    $routes->get('keluhan/add', 'KeluhanController::add');
    $routes->post('keluhan/create', 'KeluhanController::create');
    $routes->get('keluhan/edit/(:segment)', 'KeluhanController::edit/$1');
    $routes->post('keluhan/update/(:segment)', 'KeluhanController::update/$1');
    $routes->get('keluhan/detail/(:num)', 'KeluhanController::detail/$1');
    $routes->get('keluhan/delete/(:num)', 'KeluhanController::delete/$1');
    $routes->get('keluhan/konfirmasi', 'KeluhanController::konfirmasi');
    $routes->get('keluhan/approve/(:num)', 'KeluhanController::approveKeluhan/$1');
    $routes->post('keluhan/approve/(:num)', 'KeluhanController::approveKeluhan/$1');
    $routes->get('keluhan/process/(:num)', 'KeluhanController::processKeluhan/$1');
    $routes->post('keluhan/process/(:num)', 'KeluhanController::processKeluhan/$1');

    // Routes untuk mengakses controller admin beserta method yang digunukan untuk menampilkan halaman laporan
    $routes->get('laporan', 'LaporanController::index');
    $routes->get('laporan/add', 'LaporanController::add');
    $routes->post('laporan/create', 'LaporanController::create');
    $routes->get('laporan/edit/(:segment)', 'LaporanController::edit/$1');
    $routes->post('laporan/update/(:segment)', 'LaporanController::update/$1');
    $routes->get('laporan/detail/(:num)', 'LaporanController::detail/$1');
    $routes->get('laporan/delete/(:num)', 'LaporanController::delete/$1');
    $routes->get('laporan/konfirmasi', 'LaporanController::konfirmasi');
    $routes->get('laporan/approve/(:num)', 'LaporanController::approveLaporan/$1');
    $routes->post('laporan/approve/(:num)', 'LaporanController::approveLaporan/$1');
    $routes->get('laporan/process/(:num)', 'LaporanController::processLaporan/$1');
    $routes->post('laporan/process/(:num)', 'LaporanController::processLaporan/$1');

    // Routes untuk mengakses controller admin beserta method yang digunukan untuk menampilkan halaman aspirasi
    $routes->get('aspirasi', 'AspirasiController::index');
    $routes->get('aspirasi/add', 'AspirasiController::add');
    $routes->post('aspirasi/create', 'AspirasiController::create');
    $routes->get('aspirasi/edit/(:segment)', 'AspirasiController::edit/$1');
    $routes->post('aspirasi/update/(:segment)', 'AspirasiController::update/$1');
    $routes->get('aspirasi/detail/(:num)', 'AspirasiController::detail/$1');
    $routes->get('aspirasi/delete/(:num)', 'AspirasiController::delete/$1');
    $routes->get('aspirasi/konfirmasi', 'AspirasiController::konfirmasi');
    $routes->get('aspirasi/approve/(:num)', 'AspirasiController::approveAspirasi/$1');
    $routes->post('aspirasi/approve/(:num)', 'AspirasiController::approveAspirasi/$1');
    $routes->get('aspirasi/process/(:num)', 'AspirasiController::processAspirasi/$1');
    $routes->post('aspirasi/process/(:num)', 'AspirasiController::processAspirasi/$1');

    // Routes untuk mengakses controller admin beserta method yang digunukan untuk menampilkan halaman pertanyaan
    $routes->get('pertanyaan', 'PertanyaanController::index');
    $routes->get('pertanyaan/add', 'PertanyaanController::add');
    $routes->post('pertanyaan/create', 'PertanyaanController::create');
    $routes->get('pertanyaan/edit/(:segment)', 'PertanyaanController::edit/$1');
    $routes->post('pertanyaan/update/(:segment)', 'PertanyaanController::update/$1');
    $routes->get('pertanyaan/detail/(:num)', 'PertanyaanController::detail/$1');
    $routes->get('pertanyaan/delete/(:num)', 'PertanyaanController::delete/$1');
    $routes->post('pertanyaan/detail/jawaban', 'PertanyaanController::tambahJawaban');
    $routes->post('pertanyaan/detail/jawaban/update/(:num)', 'PertanyaanController::updateJawaban/$1'); // Routes untuk post data komentar yang dikirim
    $routes->get('pertanyaan/detail/deleteJawaban/(:num)', 'PertanyaanController::deleteJawaban/$1');
    $routes->post('pertanyaan/detail/deleteJawaban/(:num)', 'PertanyaanController::deleteJawaban/$1');

    // Routes untuk mengakses controller admin beserta method yang digunukan untuk menampilkan halaman berita
    $routes->get('berita', 'BeritaController::index');
    $routes->get('berita/add', 'BeritaController::add');
    $routes->post('berita/create', 'BeritaController::create');
    $routes->get('berita/edit/(:num)', 'BeritaController::edit/$1');
    $routes->post('berita/update/(:num)', 'BeritaController::update/$1');
    $routes->get('berita/delete/(:num)', 'BeritaController::delete/$1');
    $routes->delete('berita/(:num)/delete', 'BeritaController::delete/$1');
    $routes->get('berita/validation', 'BeritaController::validation');
    $routes->get('berita/approve/(:num)', 'BeritaController::approveBerita/$1'); // Routes untuk menyetujui data yang dikirim
    $routes->post('berita/approve/(:num)', 'BeritaController::approveBerita/$1'); // Routes untuk menyetujui data yang dikirim
    $routes->get('berita/reject/(:num)', 'BeritaController::rejectBerita/$1'); // Routes untuk menolak data yang dikirim
    $routes->post('berita/reject/(:num)', 'BeritaController::rejectBerita/$1'); // Routes untuk menolak data yang dikirim

    // Routes untuk mengakses controller pengguna
    $routes->get('pengguna', 'PenggunaController::index');
    $routes->post('pengguna/create', 'PenggunaController::create');
    $routes->post('pengguna/update/(:num)', 'PenggunaController::update/$1');
    $routes->get('pengguna/delete/(:num)', 'PenggunaController::delete/$1');
    $routes->delete('pengguna/(:num)/delete', 'PenggunaController::delete/$1');
});

// Routes untuk mengakses controller lurah beserta method yang digunakan
$routes->group('lurah', ['namespace' => 'App\Controllers\Lurah'], function ($routes) {

    // Routes untuk mengakses controller admin beserta method yang digunukan untuk menampilkan halaman home
    $routes->get('home', 'HomeController::index');

    // Routes untuk mengakses controller admin beserta method yang digunukan untuk menampilkan halaman profile
    $routes->get('profile', 'ProfileController::index');
    $routes->get('profile/edit/(:num)', 'ProfileController::edit/$1');
    $routes->post('profile/update/(:num)', 'ProfileController::update/$1');

    // Routes untuk mengakses controller admin beserta method yang digunukan untuk menampilkan halaman keluhan
    $routes->get('keluhan', 'KeluhanController::index');
    $routes->get('keluhan/add', 'KeluhanController::add');
    $routes->post('keluhan/create', 'KeluhanController::create');
    $routes->get('keluhan/edit/(:segment)', 'KeluhanController::edit/$1');
    $routes->post('keluhan/update/(:segment)', 'KeluhanController::update/$1');
    $routes->get('keluhan/detail/(:num)', 'KeluhanController::detail/$1');
    $routes->get('keluhan/data-pribadi', 'KeluhanController::dataPribadi');

    // Routes untuk mengakses controller admin beserta method yang digunukan untuk menampilkan halaman laporan
    $routes->get('laporan', 'LaporanController::index');
    $routes->get('laporan/add', 'LaporanController::add');
    $routes->post('laporan/create', 'LaporanController::create');
    $routes->get('laporan/edit/(:segment)', 'LaporanController::edit/$1');
    $routes->post('laporan/update/(:segment)', 'LaporanController::update/$1');
    $routes->get('laporan/detail/(:num)', 'LaporanController::detail/$1');
    $routes->get('laporan/data-pribadi', 'LaporanController::dataPribadi');

    // Routes untuk mengakses controller admin beserta method yang digunukan untuk menampilkan halaman aspirasi
    $routes->get('aspirasi', 'AspirasiController::index');
    $routes->get('aspirasi/add', 'AspirasiController::add');
    $routes->post('aspirasi/create', 'AspirasiController::create');
    $routes->get('aspirasi/edit/(:segment)', 'AspirasiController::edit/$1');
    $routes->post('aspirasi/update/(:segment)', 'AspirasiController::update/$1');
    $routes->get('aspirasi/detail/(:num)', 'AspirasiController::detail/$1');
    $routes->get('aspirasi/data-pribadi', 'AspirasiController::dataPribadi');


    // Routes untuk mengakses controller admin beserta method yang digunukan untuk menampilkan halaman pertanyaan
    $routes->get('pertanyaan', 'PertanyaanController::index');
    $routes->get('pertanyaan/add', 'PertanyaanController::add');
    $routes->post('pertanyaan/create', 'PertanyaanController::create');
    $routes->get('pertanyaan/edit/(:segment)', 'PertanyaanController::edit/$1');
    $routes->post('pertanyaan/update/(:segment)', 'PertanyaanController::update/$1');
    $routes->get('pertanyaan/detail/(:num)', 'PertanyaanController::detail/$1');
    $routes->get('pertanyaan/data-pribadi', 'PertanyaanController::dataPribadi');
    $routes->post('pertanyaan/detail/jawaban', 'PertanyaanController::tambahJawaban');
    $routes->post('pertanyaan/detail/jawaban/update/(:num)', 'PertanyaanController::updateJawaban/$1'); // Routes untuk post data komentar yang dikirim

    // Routes untuk mengakses controller admin beserta method yang digunukan untuk menampilkan halaman berita
    $routes->get('berita', 'BeritaController::index');
});

// Routes untuk mengakses controller masyarakat beserta method yang digunakan
$routes->group('masyarakat', ['namespace' => 'App\Controllers\Masyarakat'], function ($routes) {

    // Routes untuk mengakses controller admin beserta method yang digunukan untuk menampilkan halaman home
    $routes->get('home', 'HomeController::index');

    // Routes untuk mengakses controller admin beserta method yang digunukan untuk menampilkan halaman profile
    $routes->get('profile', 'ProfileController::index');
    $routes->get('profile/edit/(:num)', 'ProfileController::edit/$1');
    $routes->post('profile/update/(:num)', 'ProfileController::update/$1');

    // Routes untuk mengakses controller admin beserta method yang digunukan untuk menampilkan halaman keluhan
    $routes->get('keluhan', 'KeluhanController::index');
    $routes->get('keluhan/add', 'KeluhanController::add');
    $routes->post('keluhan/create', 'KeluhanController::create');
    $routes->get('keluhan/edit/(:segment)', 'KeluhanController::edit/$1');
    $routes->post('keluhan/update/(:segment)', 'KeluhanController::update/$1');
    $routes->get('keluhan/detail/(:num)', 'KeluhanController::detail/$1');
    $routes->get('keluhan/data-pribadi', 'KeluhanController::dataPribadi');

    // Routes untuk mengakses controller admin beserta method yang digunukan untuk menampilkan halaman laporan
    $routes->get('laporan', 'LaporanController::index');
    $routes->get('laporan/add', 'LaporanController::add');
    $routes->post('laporan/create', 'LaporanController::create');
    $routes->get('laporan/edit/(:segment)', 'LaporanController::edit/$1');
    $routes->post('laporan/update/(:segment)', 'LaporanController::update/$1');
    $routes->get('laporan/detail/(:num)', 'LaporanController::detail/$1');
    $routes->get('laporan/data-pribadi', 'LaporanController::dataPribadi');

    // Routes untuk mengakses controller admin beserta method yang digunukan untuk menampilkan halaman aspirasi
    $routes->get('aspirasi', 'AspirasiController::index');
    $routes->get('aspirasi/add', 'AspirasiController::add');
    $routes->post('aspirasi/create', 'AspirasiController::create');
    $routes->get('aspirasi/edit/(:segment)', 'AspirasiController::edit/$1');
    $routes->post('aspirasi/update/(:segment)', 'AspirasiController::update/$1');
    $routes->get('aspirasi/detail/(:num)', 'AspirasiController::detail/$1');
    $routes->get('aspirasi/data-pribadi', 'AspirasiController::dataPribadi');


    // Routes untuk mengakses controller admin beserta method yang digunukan untuk menampilkan halaman pertanyaan
    $routes->get('pertanyaan', 'PertanyaanController::index');
    $routes->get('pertanyaan/add', 'PertanyaanController::add');
    $routes->post('pertanyaan/create', 'PertanyaanController::create');
    $routes->get('pertanyaan/edit/(:segment)', 'PertanyaanController::edit/$1');
    $routes->post('pertanyaan/update/(:segment)', 'PertanyaanController::update/$1');
    $routes->get('pertanyaan/detail/(:num)', 'PertanyaanController::detail/$1');
    $routes->get('pertanyaan/data-pribadi', 'PertanyaanController::dataPribadi');
    $routes->post('pertanyaan/detail/jawaban', 'PertanyaanController::tambahJawaban');
    $routes->post('pertanyaan/detail/jawaban/update/(:num)', 'PertanyaanController::updateJawaban/$1'); // Routes untuk post data komentar yang dikirim

    // Routes untuk mengakses controller admin beserta method yang digunukan untuk menampilkan halaman berita
    $routes->get('berita', 'BeritaController::index');
});


$routes->get('404_override', 'Auth::notFound');
