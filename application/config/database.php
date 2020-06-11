<?php
defined('BASEPATH') or exit('No direct script access allowed');

$active_group = 'default';
$query_builder = TRUE;

$db['default'] = array(
	'dsn'	=> '',
	'hostname' => 'localhost',

	// Development
	'username' => 'skripsi',
	'password' => 'skripsi',
	'database' => 'db_skripsi',
	'dbdriver' => 'mysqli',

	// Publish
	// 'username' => 'andreasa_ardi',
	// 'password' => 'andre-55713',
	// 'database' => 'andreasa_sikar',
	// 'dbdriver' => 'mysqli',


	'dbprefix' => '',
	'pconnect' => FALSE,
	'db_debug' => (ENVIRONMENT !== 'production'),
	'cache_on' => FALSE,
	'cachedir' => '',
	'char_set' => 'utf8',
	'dbcollat' => 'utf8_general_ci',
	'swap_pre' => '',
	'encrypt' => FALSE,
	'compress' => FALSE,
	'stricton' => FALSE,
	'failover' => array(),
	'save_queries' => TRUE
);
