<?php

// Application Config
$key = '11fd2e941a9487e3eca443262ecc98c0';
$api = 'https://api.trello.com/1/';

$datadir = __DIR__ . '/data';
 
if (!file_exists($datadir)) {
	exec('mkdir "data"');
}


// User Config
require_once('userconfig.php');
require_once('workflows.php');

if (empty($token) || $token === '__placeholder__'){
	echo ' I need token...';
	die();
}
?>
