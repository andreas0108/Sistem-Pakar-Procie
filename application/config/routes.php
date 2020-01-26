<?php
defined('BASEPATH') or exit('No direct script access allowed');

$route['dashboard'] = 'home/dashboard';
$route['konsultasi'] = 'home/konsultasi';
$route['about'] = 'home/about';
$route['blog/(:num)'] = 'blog/index/$1';

$route['login'] = 'auth';
$route['logout'] = 'auth/logout';

$route['default_controller'] = 'home';

$route['404_override'] = '';
$route['translate_uri_dashes'] = FALSE;
