<?php

// **************************************************************************************************************************************
// Declare Some Generic Site Variables
// **************************************************************************************************************************************

	define('UNIX_TIME', $_SERVER['REQUEST_TIME']);
	define('URL_PREFIX', ((@$_SERVER['HTTPS']) ? 'https://' : 'http://'));
	define('URL_DOMAIN', $_SERVER['HTTP_HOST']);
	define('URL_FULL', URL_PREFIX.URL_DOMAIN);
	define('URL_FULL_UNSECURE', 'http://'.URL_DOMAIN);
	define('PHP_SELF', $_SERVER['PHP_SELF']);
	

// **************************************************************************************************************************************
// MySQL Settings
// **************************************************************************************************************************************

	define('MYSQL_HOST', '68.233.243.159');
	define('MYSQL_PORT', 3306);
	define('MYSQL_USER', 'classUser');
	define('MYSQL_DB', 'portal');
	define('MYSQL_PASSWORD', 'H7bmh89yAH3hs7x');	
	
?>