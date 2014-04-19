<?php
class company extends superModel {

	protected $table = 'companies';

	public function checkStatus($id) {
		$collection = $this->select("status",array("id=".addslashes($id)));
		return $collection[0]['status'];
	}

	public function getSettings($id){
		$query = $this->select("gps_time, gps_distance",array("id=".addslashes($id)));
		return $query;
	}

	public function getCommpanyId($code){
		$collection = $this->select("id",array("code='".$code."'"));
		return $collection[0]['id'];	
	}
}