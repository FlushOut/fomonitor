<?php
class mobile extends superModel {
  
	protected $table = 'mobiles';
	
	
	public function getPassword($imei) {
		
		return $this->select("password",array("imei='".addslashes($imei)."'","status=1"));
	}

	public function getIdCompany($imei) {
		
		return $this->select("fk_company",array("imei='".addslashes($imei)."'","status=1"));
	}

	public function getByImei($imei) {
		
		return $this->select("*",array("imei='".addslashes($imei)."'","status=1"));
	}	
	
	public function registrar($imei,$model,$manufacturer,$fk_company,$name,$password,$create_date) 
	{

		$dados["imei"] = "'".addslashes($imei)."'";
		$dados["model"] = "'".addslashes($model)."'";
		$dados["manufacturer"] = "'".addslashes($manufacturer)."'";
		$dados["fk_company"] = "'".addslashes($fk_ompany)."'";
		$dados["name"] = "'".addslashes($name)."'";
		$dados["password"] = "'".addslashes($password)."'";
		$dados["status"] = 1;
		$dt = $create_date;
		$dados["create_date"] ="'". addslashes(substr($dt,0,4)."-".substr($dt,4,2)."-".substr($dt,6,2)." ".substr($dt,8,2).":".substr($dt,10,2).":".substr($dt,12,2))."'";

		$reg = $this->genericQuery("select * from mobiles where imei = '".$imei."'");
		if ($reg[0]['id'])
		{
			$this->genericQuery("UPDATE mobiles SET imei=".$reg[0]['imei'].", manufacturer=".$dados["manufacturer"]." ,model=".$dados["model"]." ,fk_company=".$dados["fk_company"]." ,name=".$dados["name"]." ,contact=".$dados["contact"]." ,email=".$dados["email"]." ,password=".$dados["password"]." ,status=".$dados["status"]." ,create_date=".$dados["create_date"]." where id =".$reg[0]['id'].";");
			return $reg[0]['id'];
		}
		else
		{
			return $this->insert($dados);
		}
	}

	public function setData($imei,$date,$phoneNumber,$lat,$lon,$speed,$bearing,$accuracy,$batteryLevel,$gsmstrength,$carrier,$bytes_rx,$bytes_tx) 
	{

		$dados["imei"] = "'".addslashes($pImei)."'";
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
		
		
		
		$exists = $this->genericQuery("select * from mobile_data where imei='".$dados['imei']."' and date = '".$dados['date']."'");

		if ($exists[0]['id'])
		{
			return $exists[0]['id'];
		}
		else
		{
			return $this->insert($dados);
		}
	}

	public function getData($imei)
	{
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
								        where imei = '".$imei."' order by date_time desc limit 1");
	}

	public function getSettings($imei) {
		
		return $this->genericQuery(" select imei, wifi, screen, localsafety, apps, accounts, privacy, storage, keyboard, voice, accessibility, datetime, about from mobile_settings where imei=".$imei);
	}

	public function setSettings($imei, $wifi, $screen, $localsafety, $apps, $accounts, $privacy, 
								$storage, $keyboard, $voice, $accessibility, $about) 
	{
		
		$dados["imei"] = "'".addslashes($imei)."'";
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
		
		$reg = $this->genericQuery("select * from mobile_settings where imei = '".$imei."'");
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
								 accessibility=1 , 
								 about=1 where id=".$reg[0]['id'].";");
			return $reg[0]['id'];
		}else{
			return $this->insertTable($dados,'mobile_settings');
		}		
	}

	public function setApps($imei,$package,$name) 
	{
		$dados["imei"] = "'".addslashes($imei)."'";
		$dados["name"] = "'".addslashes($name)."'";
		$dados["package"] = "'".addslashes($package)."'";
		$dados["allowed"] = 1;
		$dados["installed"] = 1;
		
		$reg = $this->genericQuery("select * from mobile_applications where imei = ".$imei." and package = '".$package."'");

		if ($reg[0]['id'])
		{
			$this->genericQuery("replace into mobile_applications (id,imei,package,name,installed,allowed) VALUES ('".$reg[0]['id']."',".$dados["imei"].", ".$dados["package"].", ".$dados["name"].", ".$dados["installed"].", ".$dados["allowed"].")");
			return $reg[0]['id'];
		}
		else
		{
			return $this->insert($dados);
		}
	}	

	public function getApps($imei)
	{
		return $this->genericQuery("select distinct package, name from mobile_applications where imei = '".$imei."' and allowed=1 order by id");
	}


}