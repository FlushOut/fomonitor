<?php
session_start();
define('USE_PCONNECT', 'false');
error_reporting(1);
require('autoload.php');
$config['debug'] = FALSE;

// if ($_SERVER['SCRIPT_NAME'] != "/index.php") {
//     if (!isset($_SESSION['loginsession'])) redirect("/index.php");
// }

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


    $config['bd']['host'] = '127.0.0.1';
    $config['bd']['user'] = 'root';
    $config['bd']['password'] = 'mysql';
    $config['bd']['base'] = 'dbmonitor';
    $config['bd']['port'] = '3306';        

// if (strstr(curPageURL(), "d-") != false) {
    
//     $config['bd']['host'] = '127.0.0.1';
//     $config['bd']['user'] = 'root';
//     $config['bd']['password'] = '';
//     $config['bd']['base'] = 'dbmonitor';
//     $config['bd']['port'] = '3306';
    
// } else if (strstr(curPageURL(), ".com") != false) {
    
// } else {
    
// }


function redirect($url)
{
    die("<script>location.href='" . $url . "'</script>");
}

if (isset($_SESSION['loginsession'])) {
    $userweb = new user();
    $userweb->open($_SESSION['loginsession']);
    $company = new company();
    $company->open($userweb->fk_company);
    $menu = new menu();
    $list_Access = $menu->getAccess($userweb->email);
    foreach ($list_Access as $value) {
        if (strlen($value['tab'])<=0){
            if (in_array($value, $list_modules)) continue;
            $list_modules[] = $value;
        }else{
            $list_AllTabs[] = $value;
            if ($value['parent'] == $mod and $value['tab'] == 1){
                $list_tabs[] = $value;
            }
        }
        if ($value['start_module'] == 1 and $value['first_profile'] == 1){
            $url = $value['url'];
        }
    }
}

function format_date($strDate)
{
    $Y = substr($strDate, 0, 4);
    $m = substr($strDate, 5, 2);
    $d = substr($strDate, 8, 2);

    $G = substr($strDate, 11, 2);
    $i = substr($strDate, 14, 2);
    $s = substr($strDate, 17, 2);

    return "$d/$m/$Y às $G:$i:$s";
}

function verify_access($list_modules,$list_AllTabs){
    $access = 0;
    $URI="";
    $pos = strpos($_SERVER['REQUEST_URI'], '?');
    if ($pos <=0)
        $URI = $_SERVER['REQUEST_URI'];
    else
        $URI = substr($_SERVER['REQUEST_URI'], 0,strpos($_SERVER['REQUEST_URI'], '?'));
    foreach ($list_modules as $module) {
        if ($URI == $module['url']){
            $access += 1;
        }
    }
    foreach ($list_AllTabs as $tab) {
        if ($URI == $tab['url']){
            $access += 1;
        }
    }
    if ($access <=0){
        redirect("/pages/noaccess.php");
    }
}


function convertDateToTimezone($date, $format="Y-m-d H:i:s", $timezone="America/Sao_Paulo")
{
    date_default_timezone_set('Europe/London');

    if (date_default_timezone_get()) 
        $datetime_temp = new DateTime($date);
                                                
    $local_time = new DateTimeZone('America/Sao_Paulo');
    $datetime_temp->setTimezone($local_time);

    $now = $datetime_temp->format($format);
       
    return $now;        
}


