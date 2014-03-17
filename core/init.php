<?php
//Contains general information used on (almost) every page
//3/15/2014

ob_start();
session_start();

// Create a global configuration
$GLOBALS['config'] = array(
	'mysql' => array(
		'host' 		=> 'localhost',
		'username' 	=> 'root',
		'password' 	=> '',
		'db' 		=> 'gestor'
	),
	'remember' => array(
		'cookie_name'	=> 'hash',
		'cookie_expiry' =>  604800
	),
	'session' => array(
		'session_name'	=> 'user',
		'token_name'	=> 'token'
	)
);

define( 'ABPATH', 'C:/wamp/www/gestor');

// Autoload classes
function autoload($class) {
		require_once (ABPATH.'/classes/' . $class . '.php');
}
spl_autoload_register('autoload');

// Include functions
require_once (ABPATH.'/functions/sanitize.php');

