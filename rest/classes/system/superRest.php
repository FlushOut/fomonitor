<?php
/**
 * v1servico_status.php, model para a tabela v1servicos_status
 * 
 * @author Manuel Moyano <mnlmoyano@gmail.com>
 */
class superRest {
	
   /**
    * @var string que contém o método que foi chamado publicamente via URL do REST
    */		
	protected $method;

   /**
    * @var array contém a coleção de variáveis chamadas no GET
    */		
	protected $vars;

   /**
    * @var array onde são adicionadas as variáveis que serão transformadas em JSON
    */		
	protected $retorno;
   
   /**
    * @var array configuração da aplicação
    */		
	protected $config;
   
   /**
    * @var bool guarda a configuração de debug
    */		
	protected $debug; 



	/**
	 * Construtor da classe
	 * Carrega a configuração, escolhe o method, monta as variáveis de GET,
	 * eventualmente envia o usuário para a página de documentação
	 * garante a segurança do REST e direciona o usuário para a ação
	 * 
	 * @return void
	 */		
	public function __construct() {
		
		// pega as configurações definidas em config.php
		global $config;
		$this->config = $config;
		
		// verifica se está em debug
		$this->debug = $this->config['debug'];
					
		// separa URL, identifica o method e as variáveis passadas por get
		$this->explodeURL();
		
		// Se não foi chamado nenhum método, envie usuário para documentação em HTML e pare com tudo
		if(!$this->method) {
			$this->goToDocs();
		}
		
		// verifica se o método chamado na URL existe

		if (method_exists($this,$this->method)) {
			
			// para evitar injections, verifica se metodo chamado externamente é permitido
			if (!$this->checkMethod($this->method)) {
				
				// Usuario tentou chamar um método proibido
				$this->retorno["status"] = false;
				$this->retorno["error"] = "103";
				$this->retorno["message"] = "You are trying to access a private method.";				
			
			} else {				
			
				// chama o method correto
				$this->{$this->method}();
			
			}
			
		} else {
			// se não existe, informe o usuário
			$this->retorno["status"] = false;
			$this->retorno["error"] = "101";
			$this->retorno["message"] = "You are trying to access a inexistent method.";
		}
		
		// monta o retorno JSON
		$this->view($this->retorno);

	}
	
	/**
	 * Pega a URL e separa o method da requisição e as variáveis do GET
	 * 
	 * @return void
	 */			
	private function explodeURL() {
		
		// reconhece o prefixo da URL
		$urlPrefix = str_replace('index.php','',$_SERVER['SCRIPT_NAME']);
		if ($urlPrefix != '/') {
			$url = str_replace($urlPrefix,'',$_SERVER['REQUEST_URI']);

		} else {
			$url = substr($_SERVER['REQUEST_URI'],1);
		}
		
		// separa url por / para setar as variáveis
		$temp = explode('/',$url);

		// seta o method que será chamado
		//MMOYANO modificado para test
		$this->method = $temp[0];
		//$this->method = str_replace('index.php?','',$temp[0]);
		
		// seta array de variáveis GET
		for($i=1;$i<count($temp); $i+=2) {
			if (trim($temp[$i]) != '') {
			$this->vars[$temp[$i]] = $temp[$i+1];
			}
		}
	}

	/**
	 * Recebe um array e transforma em JSON
	 * 
	 * @param array $array coleção de variáveis
	 * @return string código JSON
	 */				
	private function exitJSON($array){
		return json_encode($array);
	}

	/**
	 * Recebe uma Array e printa na tela um código JSON
	 * 
	 * @param array $array coleção de variáveis
	 * @return void
	 */					
	private function view($array) {
		echo $this->exitJSON($array);
	}

	/**
	 * Envia o usuário para a página de documentação
	 * 
	 * @return void
	 */					
	private function goToDocs(){
		header('location: '.$this->config['urls']['docs']);
		die();
	}
	
	/**
	 * Verifica se existe um determinado método na classe
	 * 
	 * @param string $method 
	 * @return bool
	 */					
	private function checkMethod($method) {
		
		// verifica se metodo chamado pode ser chamado
		if(in_array($method,$this->permitidos)){
			return true;
		} else {
			return false;
		}
	}

	/**
	 * Verifica se um valor é um decimal válido
	 * 
	 * @param string $n valor a ser testado
	 * @return bool
	 */						
	protected function isDecimalNumber($n) {
		//return (string)(float)$n === (string)$n;
		return is_numeric($n);
	}

	/**
	 * Verifica se um valor é um date-time válido
	 * 
	 * @param string $daa date-time
	 * @return bool
	 */							
	protected function checkDateTime($data) {
		if (@date('YmdHis', @strtotime($data)) == $data) {
			return true;
		} else {
			return false;
		}
	}

}
?>