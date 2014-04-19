<?php
require('./config.php');
 
/*if ($_GET["debug"] == 1) {
	$config["debug"]= true;
}*/

if (!$config['debug']) {
	error_reporting(0);
} else {
	error_reporting(E_ALL);
	echo "<pre>";
}
require('./autoload.php');
if (!$config['debug']) {
	header('Content-Type: application/json');
}
if ($config['debug']) {
	print_r($_SERVER);
}
$rest = new rest();
?>
