<?php
////////////////////////////////////////////////////////////
////////////////////    Airclic - REST   ///////////////////
////////////////////////////////////////////////////////////
//                                                        //
// Este é o script de start do REST, acionado sempre      //
// por rewrite de URL configurada no .htaccess .          //
//                                                        //
// As regras de negócio ficam em ./classes                //
//                                                        //
// As configurações desta aplicação estão em ./config.php //
//                                                        //
// Para suporte, consulte rafaelkpedroso@gmail.com        //
//                                                        //
// Versão atual: 1.0-r2                                   //
//                                                        //
////////////////////////////////////////////////////////////


// inclui as configurações da aplicação
require('./config.php');


// sobrescreve configuração de debug, caso isso seja passado por GET
//if ($_GET["debug"] == 1) {
//	$config["debug"]= true;
//}

// Seta o nível de report de erro do PHP conforme a configuração de debug
if (!$config['debug']) {
	error_reporting(0);
} else {
	error_reporting(E_ALL);
	
	// também mando html montar saída como human-like
	echo "<pre>";
}

//inclui o autoload para as classes
require('./autoload.php');

// seta o cabeçalho para json (se a aplicação não estiver rodando em modo debug)
if (!$config['debug']) {
	header('Content-Type: application/json');
}

// se estiver em modo debug, exibe informações da execução do script
if ($config['debug']) {
	print_r($_SERVER);
}

// inicia a aplicação do REST
$rest = new rest();

?>
