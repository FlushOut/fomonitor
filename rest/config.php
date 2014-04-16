<?php
///////////
// Debug //
///////////

// Em produção, deve ser setado como FALSE
$config['debug'] = FALSE;


//////////
// URLs //
/////////

// URL em que o REST está rodando (não use / no final)

$config['urls']['base'] = 'http://rest.salon.fo.net.br'; //Desenvolvimento
//$config['urls']['base'] = 'http://rest.salon.fo.com.br'; //Produção
//$config['urls']['base'] = 'http://d-rest.salon.fo.net.br'; //Local
// URL em que está a documenação do REST (defutl: $config['urls']['base'].'/doc/index.html'; )

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

    /* 
    Configs Local
    */
    $config['bd']['host'] = '127.0.0.1';
    $config['bd']['user'] = 'root';
    $config['bd']['password'] = 'mysql';
    $config['bd']['base'] = 'dev_rotas';
    $config['bd']['port'] = '3306';
       
    
} else if (strstr(curPageURL(), ".com") != false) {
   
    /* 
    Configs Produção
    */

} else {
    
    /* 
    Configs Desenvolvimento
    */
    $config['bd']['host'] = '192.168.0.2';
    $config['bd']['user'] = 'dev';
    $config['bd']['password'] = '2j6NNTyzzAeFcGwb';
    $config['bd']['base'] = 'acview';
    $config['bd']['port'] = '3306';
}
 

?>
