<?php
/**
 * Created by JetBrains PhpStorm.
 * User: manuel.moyano
 * Date: 17/09/13
 * Time: 10:35
 * To change this template use File | Settings | File Templates.
 */

class status
{
	public $arrayEN;
	public $arrayPT;
	public $arrayES;

    function __construct(){

    	$this->arrayEN = array(
	    "1" => "In use",
	    "2" => "Idle",
	    "3" => "Broken",
	    "4" => "Stolen",
	    "5" => "Lost"
	    );		
    	
	    $this->arrayPT = array(
	    "1" => "Em uso",
	    "2" => "Ocioso",
	    "3" => "Defeituoso",
	    "4" => "Roubado",
	    "5" => "Desaparecido"
	    );

	    $this->arrayES = array(
	    "1" => "En uso",
	    "2" => "En desuso",
	    "3" => "Descompuesto",
	    "4" => "Robado",
	    "5" => "Desaparecido"
	    );
    }

    function getByLang($lang){
    	switch ($lang) {
    		case 'en':
    			return $this->arrayEN;
    			break;
    		case 'pt':
    			return $this->arrayPT;
    			break;
    		case 'es':
    			return $this->arrayES;
    			break;
    		default:
    			# code...
    			break;
    	}
    }
}
