<?php
class payment extends superModel {

	protected $table = 'payment';

	public function incrementUserMobile($fk_company){
		$collection = $this->genericQuery("select * from payment a where a.fk_company = '".$fk_company."' order by a.sequence desc limit 1");
		$this->genericQuery("UPDATE payment SET u_mobile = u_mobile+1 where id =".$collection[0]['id'].";");
	}
}