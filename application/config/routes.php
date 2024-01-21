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

// Route Login
$route['default_controller'] = 'auth/login';
$route['proses-login'] = 'auth/proses_login';
$route['lupa-password'] = 'auth/lupa_password';

// Route Pelanggan
$route['pelanggan/dashboard'] = 'dashboard/dashboard_pelanggan';

// Route Admin
$route['admin/dashboard'] = 'dashboard/dashboard_admin';
$route['admin/data-pengguna'] = 'pengguna/index';
$route['admin/tambah-pengguna'] = 'pengguna/tambah_pengguna';
$route['admin/proses-tambah-pengguna'] = 'pengguna/proses_tambah_pengguna';
$route['admin/edit-pengguna'] = 'pengguna/edit_pengguna';
$route['admin/proses-edit-pengguna'] = 'pengguna/proses_edit_pengguna';
$route['admin/proses-hapus-pengguna'] = 'pengguna/proses_hapus_pengguna';

// Route Manajer
$route['manajer/dashboard'] = 'dashboard/dashboard_manajer';
$route['manajer/data-pengguna'] = 'pengguna/index';

// Route Profil
$route['profil'] = 'profil/index';
$route['profil/proses-edit-profil'] = 'profil/proses_edit_profil';
