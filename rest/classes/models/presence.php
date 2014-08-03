<?php
/**
 * presence.php, model para a tabela presence
 * 
 * @author Manuel Moyano <mnlmoyano@gmail.com>
 */
class presence extends superModel {
	
	protected $table = 'stay_point';	

	public function registrar($fk_user,$user,$fk_company,$fk_point,$point,$in,$out,$time_permanence,$last_location_type) 
	{
		$dados["fk_user"] = addslashes($fk_user);
		$dados["user"] = "'".addslashes($user)."'";
		$dados["fk_company"] = "".addslashes($fk_company)."";
		$dados["fk_point"] = addslashes($fk_point);
		$dados["point"] = "'".addslashes($point)."'";
		$dados["date_in"] = "'".addslashes($in)."'";
		$dados["date_out"] = "'".addslashes($out)."'";
		$dados["time_permanence"] = addslashes($time_permanence);
		$dados["last_location_type"] = "'".addslashes($last_location_type)."'";

		return $this->insert($dados);
	}	

	public function getGeoDistance($lat1,$lon1,$lat2,$lon2,$unit) 
	{

		if ($lat1 != $lat2 && $lon1 != $lon2) {
 
            // calculate miles
            $M = 69.09 * rad2deg(acos(sin(deg2rad($lat1)) * sin(deg2rad($lat2)) + cos(deg2rad($lat1)) * cos(deg2rad($lat2)) * cos(deg2rad($lon1 - $lon2))));
 
            switch (strtoupper($unit)) {
                case 'M2':
                    // Metros
                    return (($M * 1.609344)*1000);
                    break;
                case 'K':
                    // kilometers
                    return $M * 1.609344;
                    break;
                case 'N':
                    // nautical miles
                    return $M * 0.868976242;
                    break;
                case 'F':
                    // feet
                    return $M * 5280;
                    break;
                case 'I':
                    // inches
                    return $M * 63360;
                    break;
                case 'M':
                default:
                    // miles
                    return $M;
                    break;
            }
        }else {
 
            return 0;
        }
	}

	public function getByUserPoi($fk_user,$fk_point) 
	{

		return $this->genericQuery("select id, fk_user, user, fk_point, point, date_in, date_out, time_permanence,last_location_type	
									from stay_point where fk_user = ".$fk_user." and fk_point = ".$fk_point." order by date_in desc limit 1");
	}

	public function updateNoPermanence($fk_user,$fk_point,$out,$last_location_type) 
	{
		$this->genericQuery("UPDATE stay_point SET date_out = '".$out."', 
												 last_location_type = '".$last_location_type."'
										   WHERE fk_user =".$fk_user." and fk_point =".$fk_point);
		return $fk_user;

	}

	public function updatePermanence($fk_user,$fk_point,$out,$time_permanence,$last_location_type) 
	{
		$this->genericQuery("UPDATE stay_point SET date_out = '".$out."', 
												 time_permanence = time_permanence + ".$time_permanence.",
												 last_location_type = '".$last_location_type."'
										   WHERE fk_user =".$fk_user." and fk_point =".$fk_point);
		return $fk_user;
	}

	public function updatePermanenceId($id,$out,$time_permanence,$last_location_type) 
	{
		$this->genericQuery("UPDATE stay_point SET date_out = '".$out."', 
												 time_permanence = time_permanence + ".$time_permanence.",
												 last_location_type = '".$last_location_type."'
										   WHERE id =".$id);
		return $id;
	}


	public function algRegPre($email,$lat,$lon,$datetime)
	{
		$dt = substr($datetime,0,4)."-".
			  substr($datetime,4,2)."-".
			  substr($datetime,6,2)." ".
			  substr($datetime,8,2).":".
			  substr($datetime,10,2).":".
			  substr($datetime,12,2);

		$mobile = new mobile();
		$resMobile = $mobile->getByEmail($email);

		$point = new point();
		$list_point = $point->list_point($resMobile[0]['fk_company']);

		foreach ($list_point as $poi_item) {
			$presence = $this->getByUserPoi($resMobile[0]['id'],$poi_item->id);

			if ($this->getGeoDistance($poi_item->latitude,
									  $poi_item->longitude,
									  $lat,
									  $lon,
									  'm2')<= $poi_item->radius){
				if(empty($presence)){
					return $this->registrar($resMobile[0]['id'],
											$resMobile[0]['name'],
											$resMobile[0]['fk_company'],
											$poi_item->id,
											$poi_item->name,
											$dt,
											$dt,
											0,
											'in');
				}else{
					if($presence[0]['last_location_type'] == 'in'){
						$Tperm = (strtotime($dt)-strtotime($presence[0]['date_out']));
						return $this->updatePermanenceId($presence[0]['id'],$dt,$Tperm,'in');
					}else{
						return $this->registrar($resMobile[0]['id'],
											$resMobile[0]['name'],
											$resMobile[0]['fk_company'],
											$poi_item->id,
											$poi_item->name,
											$dt,
											$dt,
											0,
											'in');
					}
				}
			}else{
				if(empty($presence)){
				}else{
					if($presence[0]['last_location_type'] == 'in'){
						$Tperm = (strtotime($dt)-strtotime($presence[0]['date_out']));
						return $this->updatePermanenceId($presence[0]['id'],$dt,$Tperm,'out');
					}
				}
			}
		}
		
	}	
}
