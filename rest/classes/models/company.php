<?php
class company extends superModel {

	protected $table = 'companies';

	public function getCommpanyById($id){
		$query = $this->select("*",array("id=".addslashes($id)));
		return $query;
	}

	public function checkStatus($id) {
		$collection = $this->select("status",array("id=".addslashes($id)));
		return $collection[0]['status'];
	}

	public function getSettings($id){
		$query = $this->select("gps_time, gps_distance, status_payment",array("id=".addslashes($id)));
		return $query;
	}

	public function getCommpanyId($code){
		$collection = $this->genericQuery("select a.id from companies a inner join categories b on b.fk_company = a.id where b.code = '".$code."'");
		return $collection[0]['id'];	
	}

	public function checkCompanyId($code)
	{
		//$collection = $this->select("*",array("code='".$code."'"));
		$collection = $this->genericQuery("select a.*,b.id as 'idCategory' from companies a inner join categories b on b.fk_company = a.id where b.code = '".$code."'");
		if(!count($collection)) {
			return false;
		}
		else
		{
			return $collection;
		}
	}
}