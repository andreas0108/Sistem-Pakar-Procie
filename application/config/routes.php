<?php
defined('BASEPATH') or exit('No direct script access allowed');
// $ci = get_instance();

$route['default_controller'] = 'home';

$route['404_override'] = '';
$route['translate_uri_dashes'] = FALSE;

$route['dashboard'] = 'home/redirect';
$route['about'] = 'home/about';
$route['blog/(:num)'] = 'blog/index/$1';

$route['login'] = 'auth';
$route['logout'] = 'auth/logout';

$route['konsultasi'] = 'home/konsultasi';
$route['konsultasi/proses'] = 'home/proses';
$route['konsultasi/hasil/(:any)'] = 'dashboard/komponen/tampil/$1';

$route['komponen'] = 'dashboard/komponen/redir';

// redirect blank breadcrumbs
$route['dashboard/komponen/ubah'] = 'dashboard/komponen/redir';
$route['dashboard/article/ubah'] = 'dashboard/article/redir';
