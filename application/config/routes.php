<?php
defined('BASEPATH') or exit('No direct script access allowed');
// $ci = get_instance();

$route['default_controller'] = 'Home';

$route['404_override'] = '';
$route['translate_uri_dashes'] = FALSE;

$route['Dashboard'] = 'Home/redirect';
$route['about'] = 'Home/about';
$route['blog/(:num)'] = 'Blog/index/$1';

$route['login'] = 'Auth';
$route['logout'] = 'Auth/logout';

$route['konsultasi'] = 'Home/konsultasi';
$route['konsultasi/cancel'] = 'Home/cancel';
$route['konsultasi/proses'] = 'Home/proses';
$route['konsultasi/hasil/(:any)'] = 'Dashboard/Komponen/Tampil/$1';

$route['komponen'] = 'Dashboard/Komponen/redir';

$route['ashboard/system/reset'] = 'Dashboard/Log/reset';

// redirect blank breadcrumbs
$route['Dashboard/Komponen/Ubah'] = 'Dashboard/Komponen/redir';
$route['Dashboard/Komponen/tampil'] = 'Dashboard/Komponen/redir';
$route['konsultasi/hasil'] = 'Dashboard/Komponen/redir';

$route['dashboard/article/ubah'] = 'Dashboard/Article/redir';
