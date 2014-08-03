<?php
class mobile extends superModel {
  
	protected $table = 'mobiles';
	
	
	public function getPassword($email) {
		
		return $this->select("password",array("email='".addslashes($email)."'","status=1"));
	}

	public function getIdCompany($email) {
		
		return $this->select("fk_company",array("email='".addslashes($email)."'","status=1"));
	}

	public function getByEmail($email) {
		
		return $this->select("*",array("email='".addslashes($email)."'","status=1"));
	}

	public function getIdByEmail($email) {
		
		return $this->select("id",array("email='".addslashes($email)."'","status=1"));
	}
	
	public function activateMobile($email,$code){
			$dataSet = $this->select("id,code_conf",array("email='".$email."'","status=1"));
			if($dataSet[0]['code_conf'] == $code){
				$this->genericQuery("UPDATE mobiles SET status_conf='1' where id =".$dataSet[0]['id'].";");
				return true;
			}else{
				return false;
			}
	}

	public function registrar($email,$model,$manufacturer,$fk_company,$name,$password,$create_date,$category_id)
	{
		$dados["email"] = "'".addslashes($email)."'";
		$dados["model"] = "'".addslashes($model)."'";
		$dados["manufacturer"] = "'".addslashes($manufacturer)."'";
		$dados["fk_company"] = "'".addslashes($fk_company)."'";
		$dados["name"] = "'".addslashes($name)."'";
		$dados["password"] = "'".addslashes($password)."'";
		$dados["status"] = 1;
		$dados["fk_category"] = "'".addslashes($category_id)."'";
		$dt = $create_date;
		$dados["create_date"] ="'". addslashes(substr($dt,0,4)."-".substr($dt,4,2)."-".substr($dt,6,2)." ".substr($dt,8,2).":".substr($dt,10,2).":".substr($dt,12,2))."'";

		$reg = $this->genericQuery("select * from mobiles where email = '".$email."'");

		$code = rand(1000,9999);

		$dados["code_conf"] = $code;

		$dados["status_conf"] = 0;

		$this->sendEmail($email,$dados["code_conf"]);

		if ($reg[0]['id'])
		{
			$this->genericQuery("UPDATE mobiles SET email='".$reg[0]['email']."', manufacturer=".$dados["manufacturer"]." ,model=".$dados["model"]." ,fk_company=".$dados["fk_company"]." ,name=".$dados["name"]." ,contact='".$dados["contact"]."' ,password=".$dados["password"]." ,status=".$dados["status"]." ,last_update=".$dados["create_date"]." ,fk_category=".$dados["fk_category"]." ,code_conf=".$dados["code_conf"]." ,status_conf=".$dados["status_conf"]." where id =".$reg[0]['id'].";");
			return $reg[0]['id'];
		}
		else
		{
			$payment = new payment();
			$payment->incrementUserMobile($fk_company);
			return $this->insert($dados);
		}
	}

	public function sendEmail($dest,$code){		 
		// Estas son cabeceras que se usan para evitar que el correo llegue a SPAM:
		$headers = "From: contact@flushoutsolutions.com\r\n";
		$headers .= "X-Mailer: PHP5\n";
		$headers .= 'MIME-Version: 1.0' . "\n";
		$headers .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";
		// Aqui definimos el asunto y armamos el cuerpo del mensaje
		$asunto = "Confirmation Code";

		$body = "<div marginheight='0' marginwidth='0' style='font-family:Helvetica Neue,Helvetica,Arial,sans-serif;line-height:21px;color:#404040'>";
        $body .= "<div style='max-width:650px;margin:0 auto;padding:20px 0'>";
        $body .= "<table width='100%' cellpadding='0' cellspacing='0' border='0' style='font-family:Helvetica,Arial;font-size:12px;color:#404040'>";
        $body .= "  <tbody>";
        $body .= "   <tr>";
        $body .=    "  <td width=100%'>";   
        $body .= "<table bgcolor='#FFFFFF' width='97%' cellpadding='0' cellspacing='0' border='0' align='center' style='border-radius:4px;font-family:Helvetica,Arial;font-size:12px;color:#404040;border:1px solid #ddd'>";
        $body .= "    <tbody>";
        $body .= "       <tr>";
        $body .= "                    <td width='100%''>";
        $body .= "                        <table width='100%' cellpadding='0' cellspacing='0' border='0' style='font-family:Helvetica,Arial;font-size:12px;color:#404040'>";
        $body .= "                            <tbody>";
        $body .= "                                <tr>";
        $body .= "                                    <td bgcolor='#f2f2f2' width='100%'' style='border-radius:3px 3px 0px 0px;font-size:34px;font-weight:700;letter-spacing:-1px;border-bottom-style:solid;border-bottom-color:#ddd;border-bottom-width:1px;padding:20px 20px 20px'>";
        $body .= "                                        <img src='http://monitor.flushoutsolutions.com/img/flushout-logo.png' width='120' height='76' alt='FlushOut' style='display:block;border:0'>";
        $body .= "                                    </td>";
        $body .= "                                </tr>";
        $body .= "                                <tr>";
        $body .= "                                    <td width='100%' style='padding:30px 30px 20px'>";           
        $body .= "                                       <h1 style='font-size:24px;font-weight:700;margin:0 0 5px;padding:0 0 6px;border:0;color:#404040 !important'>Welcome! Please validate your email</h1>";
        $body .= "                                        <div>Thanks for signing up with FOMonitor! Your Code is: <strong>".$code."</strong>.</div>";  
        $body .= "                                    </td>";
        $body .= "                                </tr>";
        $body .= "                            </tbody>";
        $body .= "                        </table>";
        $body .= "                    </td>";
        $body .= "                </tr>";
        $body .= "            </tbody>";
        $body .= "        </table>";
        $body .= "        </td>";
        $body .= "        </tr>";
        $body .= "        </tbody>";
        $body .= "        </table>";
        $body .= "        </div>";
        $body .= "        </div>";

		// Esta es una pequena validación, que solo envie el correo si todas las variables tiene algo de contenido:
		mail($dest,$asunto,$body,$headers); //ENVIAR!
	}

	public function setData($email,$date,$phoneNumber,$lat,$lon,$speed,$bearing,$accuracy,$batteryLevel,$gsmstrength,$carrier,$bytes_rx,$bytes_tx) 
	{

		$dataset = $this->getIdByEmail($email);
		$dados["fk_mobile"] = $dataset[0]['id'];
		$dt = $date;
		$dados["date"] ="'". addslashes(substr($dt,0,4)."-".substr($dt,4,2)."-".substr($dt,6,2)." ".
								  substr($dt,8,2).":".substr($dt,10,2).":".substr($dt,12,2))."'";
		$dados["phonenumber"] = "'".addslashes($phoneNumber)."'";
		$dados["latitude"] = "'".addslashes($lat)."'";
		$dados["longitude"] = "'".addslashes($lon)."'";
		$dados["speed"] = "'".addslashes($speed)."'";
		$dados["bearing"] = "'".addslashes($bearing)."'";
		$dados["accuracy"] = "'".addslashes($accuracy)."'";
		$dados["batterylevel"] = "'".addslashes($batteryLevel)."'";
		$dados["gsmstrength"] = "'".addslashes($gsmstrength)."'";
		$dados["carrier"] = "'". addslashes($pCarrier)."'";
		$dados["bytes_rx"] = "'". addslashes($pBytesRX)."'";
		$dados["bytes_tx"] = "'". addslashes($pBytesTX)."'";
		
		
		
		$exists = $this->genericQuery("select * from mobile_data where fk_mobile='".$dados['fk_mobile']."' and date = '".$dados['date']."'");

		if ($exists[0]['id'])
		{
			return $exists[0]['id'];
		}
		else
		{
			return $this->insertTable($dados,'mobile_data');
		}
	}

	public function getData($email)
	{
		$dataset = $this->getIdByEmail($email);
		$fk_mobile = $dataset[0]['id'];
		return $this->genericQuery("select date, 
									phonenumber, 
									   latitude, 
									  longitude, 
									      speed, 
									    bearing, 
									   accuracy, 
								   batterylevel,
								    gsmstrength, 
								        carrier, 
								       bytes_rx,
								       bytes_tx,
								        from mobile_data 
								        where fk_mobile = '".$fk_mobile."' order by date_time desc limit 1");
	}

	public function getSettings($email) {
		
		$dataset = $this->getIdByEmail($email);
		$fk_mobile = $dataset[0]['id'];
		return $this->genericQuery(" select wifi, screen, localsafety, apps, accounts, privacy, storage, keyboard, voice, accessibility, datetime, about from mobile_settings where fk_mobile=".$fk_mobile);
	}

	public function setSettings($email, $wifi, $screen, $localsafety, $apps, $accounts, $privacy, 
								$storage, $keyboard, $voice, $accessibility, $about, $datetime) 
	{
		$dataset = $this->getIdByEmail($email);

		$dados["fk_mobile"] = $dataset[0]['id'];
		$dados["wifi"] = "'".addslashes($wifi)."'";
		$dados["screen"] = "'".addslashes($screen)."'";
		$dados["localsafety"] = "'".addslashes($localsafety)."'";
		$dados["apps"] = "'".addslashes($apps)."'";
		$dados["accounts"] = "'".addslashes($accounts)."'";
		$dados["privacy"] = "'".addslashes($privacy)."'";
		$dados["storage"] = "'".addslashes($storage)."'";
		$dados["keyboard"] = "'".addslashes($keyboard)."'";
		$dados["voice"] = "'".addslashes($voice)."'";
		$dados["accessibility"] = "'".addslashes($accessibility)."'";
		$dados["about"] = "'".addslashes($about)."'";
		$dados["datetime"] = "'".addslashes($datetime)."'";

		$reg = $this->genericQuery("select * from mobile_settings where fk_mobile = '".$dados["fk_mobile"]."'");
		if ($reg[0]['id'])
		{
			$this->genericQuery("update mobile_settings SET 
								 wifi=1, 
								 screen=1, 
								 localsafety=1, 
								 apps=1, 
								 accounts=1, 
								 privacy=1, 
								 storage=1, 
								 keyboard=1, 
								 voice=1, 
								 accessibility=1,
								 datetime=1,
								 about=1 where id=".$reg[0]['id'].";");
			return $reg[0]['id'];
		}else{
			return $this->insertTable($dados,'mobile_settings');
		}		
	}

	public function setApps($email,$package,$name) 
	{
		$dataset = $this->getIdByEmail($email);
		$dados["fk_mobile"] = $dataset[0]['id'];
		$dados["name"] = "'".addslashes($name)."'";
		$dados["package"] = "'".addslashes($package)."'";
		$dados["allowed"] = 1;
		$dados["installed"] = 1;
		
		$reg = $this->genericQuery("select * from mobile_applications where fk_mobile = ".$dados["fk_mobile"]." and package = '".$package."'");

		if ($reg[0]['id'])
		{
			$this->genericQuery("replace into mobile_applications (id,fk_mobile,package,name,installed,allowed) VALUES ('".$reg[0]['id']."',".$dados["fk_mobile"].", ".$dados["package"].", ".$dados["name"].", ".$dados["installed"].", ".$dados["allowed"].")");
			return $reg[0]['id'];
		}
		else
		{
			return $this->insertTable($dados,'mobile_applications');
		}
	}	

	public function getApps($email)
	{
		$dataset = $this->getIdByEmail($email);
		$fk_mobile = $dataset[0]['id'];
		return $this->genericQuery("select distinct package, name from mobile_applications where fk_mobile = '".$fk_mobile."' and allowed=1 order by id");
	}


}