<?php
session_start();
define('USE_PCONNECT', 'false');
error_reporting(1);
date_default_timezone_set($_COOKIE['timezone']);
require('autoload.php');
$config['debug'] = TRUE;

//Variable local de precios
$priceUserWeb = 9.9;
$priceUserMobile = 6.9;

if ($_SERVER['SCRIPT_NAME'] != "/index.php") {
     if (!isset($_SESSION['loginsession']) && (!$ve)) redirect("/index.php");
}

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
    
} else if (strstr(curPageURL(), ".com") != false) {
    $config['bd']['host'] = 'flushoutsolutionscom.ipagemysql.com';
    $config['bd']['user'] = 'monitoruser';
    $config['bd']['password'] = 'M0n!t0r220591';
    $config['bd']['base'] = 'dbmonitor';
    $config['bd']['port'] = '3306';
}

function redirect($url)
{
    die("<script>location.href='" . $url . "'</script>");
}

if (isset($_SESSION['loginsession'])) {
    $user = new user();
    $user->open($_SESSION['loginsession']);
    $company = new company();
    $company->open($user->fk_company);
    $menu = new menu();
    $isAdmin = false;
    $list_Access = $menu->getAccess($user->email);
    foreach ($list_Access as $value) {
        if (is_array($list_modules)) {
            if (in_array($value, $list_modules)) {
                continue;
            }
        }
        $list_modules[] = $value;
        if($value['fk_profile'] == 1) $isAdmin = true;
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

    return "$d/$m/$Y at $G:$i:$s";
}

function verify_access(){
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
    if ($access <=0){
        redirect("/pages/noaccess.php");
    }
}

function money_format($format, $number) 
{ 
    $regex  = '/%((?:[\^!\-]|\+|\(|\=.)*)([0-9]+)?'. 
              '(?:#([0-9]+))?(?:\.([0-9]+))?([in%])/'; 
    if (setlocale(LC_MONETARY, 0) == 'C') { 
        setlocale(LC_MONETARY, ''); 
    } 
    $locale = localeconv(); 
    preg_match_all($regex, $format, $matches, PREG_SET_ORDER); 
    foreach ($matches as $fmatch) { 
        $value = floatval($number); 
        $flags = array( 
            'fillchar'  => preg_match('/\=(.)/', $fmatch[1], $match) ? 
                           $match[1] : ' ', 
            'nogroup'   => preg_match('/\^/', $fmatch[1]) > 0, 
            'usesignal' => preg_match('/\+|\(/', $fmatch[1], $match) ? 
                           $match[0] : '+', 
            'nosimbol'  => preg_match('/\!/', $fmatch[1]) > 0, 
            'isleft'    => preg_match('/\-/', $fmatch[1]) > 0 
        ); 
        $width      = trim($fmatch[2]) ? (int)$fmatch[2] : 0; 
        $left       = trim($fmatch[3]) ? (int)$fmatch[3] : 0; 
        $right      = trim($fmatch[4]) ? (int)$fmatch[4] : $locale['int_frac_digits']; 
        $conversion = $fmatch[5]; 

        $positive = true; 
        if ($value < 0) { 
            $positive = false; 
            $value  *= -1; 
        } 
        $letter = $positive ? 'p' : 'n'; 

        $prefix = $suffix = $cprefix = $csuffix = $signal = ''; 

        $signal = $positive ? $locale['positive_sign'] : $locale['negative_sign']; 
        switch (true) { 
            case $locale["{$letter}_sign_posn"] == 1 && $flags['usesignal'] == '+': 
                $prefix = $signal; 
                break; 
            case $locale["{$letter}_sign_posn"] == 2 && $flags['usesignal'] == '+': 
                $suffix = $signal; 
                break; 
            case $locale["{$letter}_sign_posn"] == 3 && $flags['usesignal'] == '+': 
                $cprefix = $signal; 
                break; 
            case $locale["{$letter}_sign_posn"] == 4 && $flags['usesignal'] == '+': 
                $csuffix = $signal; 
                break; 
            case $flags['usesignal'] == '(': 
            case $locale["{$letter}_sign_posn"] == 0: 
                $prefix = '('; 
                $suffix = ')'; 
                break; 
        } 
        if (!$flags['nosimbol']) { 
            $currency = $cprefix . 
                        ($conversion == 'i' ? $locale['int_curr_symbol'] : $locale['currency_symbol']) . 
                        $csuffix; 
        } else { 
            $currency = ''; 
        } 
        $space  = $locale["{$letter}_sep_by_space"] ? ' ' : ' '; 

        $value = number_format($value, $right, $locale['mon_decimal_point'], 
                 $flags['nogroup'] ? '' : $locale['mon_thousands_sep']); 
        $value = @explode($locale['mon_decimal_point'], $value); 

        $n = strlen($prefix) + strlen($currency) + strlen($value[0]); 
        if ($left > 0 && $left > $n) { 
            $value[0] = str_repeat($flags['fillchar'], $left - $n) . $value[0]; 
        } 
        $value = implode($locale['mon_decimal_point'], $value); 
        if ($locale["{$letter}_cs_precedes"]) { 
            $value = $prefix . $currency . $space . $value . $suffix; 
        } else { 
            $value = $prefix . $value . $space . $currency . $suffix; 
        } 
        if ($width > 0) { 
            $value = str_pad($value, $width, $flags['fillchar'], $flags['isleft'] ? 
                     STR_PAD_RIGHT : STR_PAD_LEFT); 
        } 

        $format = str_replace($fmatch[0], $value, $format); 
    } 
    return $format; 
} 

/*function convertDateToTimezone($date, $format="Y-m-d H:i:s", $timezone="America/Sao_Paulo")
{
    date_default_timezone_set('Europe/London');

    if (date_default_timezone_get()) 
        $datetime_temp = new DateTime($date);
                                                
    $local_time = new DateTimeZone('America/Sao_Paulo');
    $datetime_temp->setTimezone($local_time);

    $now = $datetime_temp->format($format);
       
    return $now;        
}*/


