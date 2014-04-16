<?php
/**
 * rest.php
 * contém todas as URLs e regras de negócio do REST Airclic
 * 
 * @author Manuel Moyano <mnlmoyano@gmail.com>
 */
class rest extends superRest {

   /**
	* @var array os métodos que podem ser chamados por URL
	*/		
	protected $permitidos = array('');
	

	public function version() 
	{		
		$this->retorno['status'] = true;
		$this->retorno['ver'] = "1";
	}

	
}
	