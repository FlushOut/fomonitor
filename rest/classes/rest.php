<?php

class rest extends superRest {

	protected $permitidos = array('version','validate','send_information','send_apps','get_apps','get_settings','send_data','getcompanysettings','getuserdata');
	

	public function version() 
	{		
		$this->retorno['status'] = true;
		$this->retorno['ver'] = "1";
	}

	public function validate() 
	{
		$company = new company();
		$exists = $company->checkCompanyId($this->vars['code']);
		

		if($exists !== false)
		{
			$this->retorno["status"] = true;
			$this->retorno["company"] = $exists[0]['name'];	
		}
		else
		{
			$this->retorno["status"] = false;
			$this->retorno["message"] = "Invalid company code.";
		}
	}

	public function send_information() 
	{
		if (!$this->vars['imei']
			or !$this->vars['code']
			or !$this->vars['name']
			or !$this->vars['password']
			or !$this->vars['date']
			or !$this->vars['model']
			or !$this->vars['manufacturer']
			) {

			$this->retorno["status"] = false;
			$this->retorno["error"] = "103";
			$this->retorno["message"] = "Please send all the 7 parameters to execute this function.";
		} 
		else 
		{
			$erro = false;
			$company = new company();
			$companyId = $company->getCommpanyId($this->vars['code']);			

			if (!$erro) {

				$mobile = new mobile();
				$id = $mobile->registrar($this->vars['imei'], urldecode($this->vars['model']),  urldecode($this->vars['manufacturer']), $companyId, urldecode($this->vars['name']), $this->vars['password'], $this->vars['date']);
				
				$mobile->setSettings($this->vars['imei'], 1, 1, 1, 1, 1, 1,
														  1, 1, 1, 1, 1);
				if($id) {
					$this->retorno['status'] = true;				
				} else {
					$this->retorno['status'] = false;				
				}	
			} 
			else {
				$this->retorno['status'] = false;				
			}
		}
	}

	public function send_apps() 
	{
		if (!$this->vars['imei']
			or !$this->vars['package']
			or !$this->vars['name']
			) {
			$this->retorno["status"] = false;
			$this->retorno["error"] = "103";
			$this->retorno["message"] = "Please send all the 3 parameters to execute this function.";
		} 
		else 
		{
			$erro = false;
			if (!$erro) {
				$mobile = new mobile();
				$appname = urldecode($this->vars['name']);
				$appname = str_replace("[\]", "/", $appname);
				$id = $mobile->setApps($this->vars['imei'], $this->vars['package'], $appname);
				if($id) {
					$this->retorno['status'] = true;				
				} else {
					$this->retorno['status'] = false;				
				}
			} 
			else {
				$this->retorno['status'] = false;				
			}
		}
	}
	public function get_apps() 
	{
		// valida se foram enviados todos os dados obrigatórios para a função
		if (!$this->vars['imei']) {
				 
			// se os dados não foram passados, informe o erro
			$this->retorno["status"] = false;
			$this->retorno["error"] = "119";
			$this->retorno["message"] = "Please send the IMEI parameter to execute this function.";
		} 
		else 
		{
			// vamos verificar se os parâmetros estão de acordo
			$erro = false;

			if (!$erro) {
					
				$mobile = new mobile();
				$this->retorno['apps'] = $mobile->getApps($this->vars['imei']);
				$this->retorno['status'] = true;
			} 
			else {
				// deu erro de validação, apenas sete status complementar como false
				$this->retorno['status'] = false;				
			}
		}
	}

	public function get_settings()
	{
		if (!$this->vars['imei']) {
			$this->retorno["status"] = false;
			$this->retorno["error"] = "106";
			$this->retorno["message"] = "IMEI missing.";
		} 
		else 
		{
			$erro = false;
			if (!$erro) {
				$mobile = new mobile();
				$dataSet = $mobile->getSettings($this->vars['imei']);
				if(!count($dataSet)) {
					$this->retorno['status'] = false;
				}
				else
				{
					$this->retorno['settings'] = $dataSet;
					$this->retorno['status'] = true;
				}
			} 
			else {
				$this->retorno['status'] = false;
			}
		}
	}

	public function send_data() 
	{
		// valida se foram enviados todos os dados obrigatórios para a função
		if (!$this->vars['id']
			or !$this->vars['imei']
			or !$this->vars['date']
			or !$this->vars['phonenumber']
			or !$this->vars['lat']
			or !$this->vars['lon']
			or !$this->vars['speed']
			or !$this->vars['bearing']
			or !$this->vars['accuracy']
			or !$this->vars['batterylevel']
			or !$this->vars['gsmstrength']
			or !$this->vars['carrier']
			) {
			$this->retorno["status"] = false;
			$this->retorno["error"] = "106";
			$this->retorno["message"] = "Please send all the 12 parameters to execute this function.";
		} 
		else 
		{
			$erro = false;
			if(!$this->isDecimalNumber($this->vars['lat'])) {
				$this->retorno["error"] = "107";
				$this->retorno["message"] = "lat need to be a valid float.";							
				$erro = true;	
			}

			if(!$this->isDecimalNumber($this->vars['lon'])) {
				$this->retorno["error"] = "108";
				$this->retorno["message"] = "lon need to be a valid float.";								
				$erro = true;	
			}
				
			if(!$this->checkDateTime($this->vars['date'])) {
				$this->retorno["error"] = "110";
				$this->retorno["message"] = "datetime is not in a valid format.";								
				$erro = true;	
			}

			if (!$erro) {
					
				$bytes_rx = $this->vars['bytes_rx'];
				if (!$this->vars['bytes_rx']) $bytes_rx = 0;

				$bytes_tx = $this->vars['bytes_tx'];
				if (!$this->vars['bytes_tx']) $bytes_tx = 0;

				$mobile = new mobile();
				$id = $mobile->setData($this->vars['imei'],
												$this->vars['date'],
												$this->vars['phonenumber'],
												$this->vars['lat'],
												$this->vars['lon'],
												$this->vars['speed'],
												$this->vars['bearing'],
												$this->vars['accuracy'],
												$this->vars['batterylevel'],
												$this->vars['gsmstrength'],
												$this->vars['carrier'],
												$bytes_rx,
												$bytes_tx);
				if(isset($id)) 
				{
					$this->retorno['id'] = $this->vars['id'];	
					$this->retorno['status'] = true;				
				} else {
					$this->retorno['status'] = false;				
				}		
			} 
			else {
				$this->retorno['status'] = false;				
			}
		}
	}

	public function get_data() 
	{
		if (!$this->vars['imei']) {
			$this->retorno["status"] = false;
			$this->retorno["error"] = "106";
			$this->retorno["message"] = "IMEI missing.";
		} 
		else 
		{
			$erro = false;
			if (!$erro) {
				$mobile = new mobile();
				$result = $mobile->getData($this->vars['imei']);

				if($result) {
					$this->retorno['coords'] = $result;	
					$this->retorno['status'] = true;
				}
				else
				{
					$this->retorno['status'] = false;
				}					
			} 
			else {
				// deu erro de validação, apenas sete status complementar como false
				$this->retorno['status'] = false;				
			}
		}
	
	}

	public function getcompanysettings() 
	{
		$imei = $this->vars['imei'];

		$user = new user();
		$dataSet = $user->getCompanyId($imei);
		if(!count($dataSet)) {
			$this->retorno['status'] = false;
		}
		else
		{
			$companyId = $dataSet[0]['fk_company'];
			$company = new company();
			$settings =  $company->getSettings($companyId);
			
			if(!count($dataSet)) {
				$this->retorno['status'] = false;
			}
			else{
				$this->retorno["settings"] = $settings[0];
				$this->retorno["status"] = true;
			}
		}
	}
	public function getuserdata() 
	{
		$this->retorno["status"] = true;
		
		$mobile = new mobile();
		$resUser = $mobile->getByImei($this->vars['imei']);

		$this->retorno["name"] = $resUser[0]['name'];
		$this->retorno["email"] = $resUser[0]['email'];
		$this->retorno["contact"] = $resUser[0]['contact'];
	}
}
	