<?php
$config['debug'] = FALSE;

//$config['urls']['base'] = 'http://r-monitor.flushoutsolutions.com'; //Produção
$config['urls']['base'] = 'http://d-r-monitor.flushoutsolutions.com'; //Local
$config['urls']['docs'] = $config['urls']['base'].'/doc/index.html'; 


function curPageURL()
{
    $pageURL = '';
    if ($_SERVER["SERVER_PORT"] != "80") {
        $pageURL .= $_SERVER["SERVER_NAME"] . ":" . $_SERVER["SERVER_PORT"] . $_SERVER["REQUEST_URI"];
    } else {
        $pageURL .= $_SERVER["SERVER_NAME"] . $_SERVER["REQUEST_URI"];
    }
    return substr($pageURL, 0, 50);
}

if (strstr(curPageURL(), "d-") != false) {
    $config['bd']['host'] = '127.0.0.1';
    $config['bd']['user'] = 'root';
    $config['bd']['password'] = 'mysql';
    $config['bd']['base'] = 'dbmonitor';
    $config['bd']['port'] = '3306';
}elseif (strstr(curPageURL(), ".com") != false) {

} 
?>
