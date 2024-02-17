<?php
defined('BASEPATH') or exit('No direct script access allowed');

/*
| -------------------------------------------------------------------------
| URI ROUTING
| -------------------------------------------------------------------------
| This file lets you re-map URI requests to specific controller functions.
|
| Typically there is a one-to-one relationship between a URL string
| and its corresponding controller class/method. The segments in a
| URL normally follow this pattern:
|
|	example.com/class/method/id/
|
| In some instances, however, you may want to remap this relationship
| so that a different class/function is called than the one
| corresponding to the URL.
|
| Please see the user guide for complete details:
|
|	https://codeigniter.com/userguide3/general/routing.html
|
| -------------------------------------------------------------------------
| RESERVED ROUTES
| -------------------------------------------------------------------------
|
| There are three reserved routes:
|
|	$route['default_controller'] = 'welcome';
|
| This route indicates which controller class should be loaded if the
| URI contains no data. In the above example, the "welcome" class
| would be loaded.
|
|	$route['404_override'] = 'errors/page_missing';
|
| This route will tell the Router which controller/method to use if those
| provided in the URL cannot be matched to a valid route.
|
|	$route['translate_uri_dashes'] = FALSE;
|
| This is not exactly a route, but allows you to automatically route
| controller and method names that contain dashes. '-' isn't a valid
| class or method name character, so it requires translation.
| When you set this option to TRUE, it will replace ALL dashes in the
| controller and method URI segments.
|
| Examples:	my-controller/index	-> my_controller/index
|		my-controller/my-method	-> my_controller/my_method
*/
$route['404_override'] = 'custom404';
$route['translate_uri_dashes'] = TRUE;
$route['default_controller'] = 'auth/index';

// Route Auth Pegawai
$route['login-pegawai'] = 'auth/login_pegawai';
$route['proses-login-pegawai'] = 'auth/proses_login_pegawai';
$route['lupa-password'] = 'auth/lupa_password';
$route['kirim-reset-password'] = 'auth/send_reset_link';
$route['reset-password'] = 'auth/reset_password';
$route['proses-reset-password'] = 'auth/proses_reset_password';

// Route Manajer
$route['manajer/dashboard'] = 'dashboard/dashboard_manajer';
$route['manajer/data-pegawai'] = 'pegawai/index';
$route['manajer/tambah-pegawai'] = 'pegawai/tambah_pegawai';
$route['manajer/proses-tambah-pegawai'] = 'pegawai/proses_tambah_pegawai';
$route['manajer/edit-pegawai'] = 'pegawai/edit_pegawai';
$route['manajer/proses-edit-pegawai'] = 'pegawai/proses_edit_pegawai';

$route['manajer/data-pelanggan'] = 'pelanggan/index';

$route['manajer/data-lokasi-server'] = 'lokasi_server/index';
$route['manajer/tambah-lokasi-server'] = 'lokasi_server/tambah_lokasi_server';
$route['manajer/proses-tambah-lokasi-server'] = 'lokasi_server/proses_tambah_lokasi_server';
$route['manajer/edit-lokasi-server'] = 'lokasi_server/edit_lokasi_server';
$route['manajer/proses-edit-lokasi-server'] = 'lokasi_server/proses_edit_lokasi_server';

$route['manajer/data-pernyataan'] = 'pernyataan/index';
$route['manajer/tambah-pernyataan'] = 'pernyataan/tambah_pernyataan';
$route['manajer/proses-tambah-pernyataan'] = 'pernyataan/proses_tambah_pernyataan';
$route['manajer/edit-pernyataan'] = 'pernyataan/edit_pernyataan';
$route['manajer/proses-edit-pernyataan'] = 'pernyataan/proses_edit_pernyataan';
$route['manajer/proses-hapus-pernyataan'] = 'pernyataan/proses_hapus_pernyataan';

$route['manajer/data-kuesioner'] = 'kuesioner/index';
$route['manajer/tambah-kuesioner'] = 'kuesioner/tambah_kuesioner';
$route['manajer/proses-tambah-kuesioner'] = 'kuesioner/proses_tambah_kuesioner';
$route['manajer/edit-kuesioner'] = 'kuesioner/edit_kuesioner';
$route['manajer/proses-edit-kuesioner'] = 'kuesioner/proses_edit_kuesioner';
$route['manajer/proses-hapus-kuesioner'] = 'kuesioner/proses_hapus_kuesioner';

$route['manajer/data-evaluasi'] = 'evaluasi/index';
$route['manajer/cetak-evaluasi-pdf'] = 'evaluasi/cetak_pdf';
$route['manajer/jawaban-pelanggan'] = 'jawaban/jawaban_pelanggan';

// Route admin
$route['admin/dashboard'] = 'dashboard/dashboard_admin';
$route['admin/data-pegawai'] = 'pegawai/index';

$route['admin/data-pelanggan'] = 'pelanggan/index';
$route['admin/tambah-pelanggan'] = 'pelanggan/tambah_pelanggan';
$route['admin/proses-tambah-pelanggan'] = 'pelanggan/proses_tambah_pelanggan';
$route['admin/edit-pelanggan'] = 'pelanggan/edit_pelanggan';
$route['admin/proses-edit-pelanggan'] = 'pelanggan/proses_edit_pelanggan';

$route['admin/data-kuesioner'] = 'kuesioner/index';
$route['admin/isi-pernyataan'] = 'kuesioner/isi_pernyataan';
$route['admin/proses-isi-pernyataan'] = 'kuesioner/proses_isi_pernyataan';

// Route Pelanggan
$route['pelanggan/kuesioner'] = 'kuesioner/index';
$route['pelanggan/isi-kuesioner'] = 'jawaban/tambah_jawaban';
$route['pelanggan/proses-isi-kuesioner'] = 'jawaban/proses_tambah_jawaban';

// Route Profil
$route['profil'] = 'profil/index';
$route['profil/proses-edit-profil-pegawai'] = 'profil/proses_edit_profil_pegawai';
$route['profil/proses-edit-profil_pelanggan'] = 'profil/proses_edit_profil_pelanggan';
