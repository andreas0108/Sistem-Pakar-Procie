<?php
defined('BASEPATH') or exit('No direct script access allowed');
/*
| Examples:	my-controller/index	-> my_controller/index
|		my-controller/my-method	-> my_controller/my_method
*/

// Config
$route['default_controller'] = 'home';
$route['404_override'] = '';
$route['translate_uri_dashes'] = FALSE;

// Home
$route['procie'] = 'home/procie';

// Dashboard
$route['login'] = 'dashboard/auth';
$route['logout'] = 'dashboard/auth/logout';
$route['register'] = 'dashboard/auth/registration';
$route['blocked'] = 'dashboard/auth/blocked';
$route['dashboard'] = 'dashboard/home';

$route['dashboard/user/(:num)'] = 'dashboard/user/index/$1';
$route['blog/(:num)'] = 'blog/index/$1';
// $route['blog/']
