<?php
/**
 * presence.php, model para a tabela presence
 * 
 * @author Manuel Moyano <mnlmoyano@gmail.com>
 */
class route extends superModel {
	
	protected $table = 'route_map';	

	public function registrar($idMobile,$date,$latitude,$longitude) 
	{
		$dados["fk_mobile"] = addslashes($idMobile);
		$dados["date"] = "'".addslashes($date)."'";
		$dados["points"] = "'".addslashes("".$latitude.",".$longitude."")."'";

		return $this->insert($dados);
	}

	public function updateRoute($id,$latitude,$longitude)
	{
		$pointExist =  $this->genericQuery("SELECT 1 FROM route_map WHERE id =".$id." and points like '%;".$latitude.",".$longitude."%'");
		if(empty($pointExist)){
			$this->genericQuery("UPDATE route_map SET points = CONCAT(points,';".$latitude.",".$longitude."') WHERE id =".$id);
		}
		return $id;
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

	public function getByMobile($fk_mobile,$dt)
	{
		return $this->genericQuery("select id, date, fk_mobile, points from route_map where fk_mobile = ".$fk_mobile." and DATE(date) = DATE('".$dt."') ");
	}

	public function algRegRou($email,$lat,$lon,$datetime)
	{
		$dt = substr($datetime,0,4)."-".
			  substr($datetime,4,2)."-".
			  substr($datetime,6,2)." ".
			  substr($datetime,8,2).":".
			  substr($datetime,10,2).":".
			  substr($datetime,12,2);
		$mobile = new mobile();
		$resMobile = $mobile->getByEmail($email);

		$company = new company();
		$resCompany = $company->getCommpanyById($resMobile[0]['fk_company']);

		$route = $this->getByMobile($resMobile[0]['id'],$dt);

		if(empty($route)){

			return $this->registrar($resMobile[0]['id'],
									$dt,
									$lat,
									$lon);

		}else{

			$listLocation = explode(";",$resMobile[0]['points']);
			$location = $listLocation[count($listLocation)-1];
			$listPoint = explode(",",$location);
			$lat2 = $listPoint[0];
			$lon2 = $listPoint[1];

			if (intval($this->getGeoDistance($lat,
								      $lon,
								      $lat2,
								      $lon2,
								      'm2')) >= intval($resCompany[0]['gps_distance']))
			{

				return $this->updateRoute($route[0]['id'],
										  $lat,
	  									  $lon);
/*				if(strtotime($dt) - strtotime($route[0]['date']) <=($resCompany[0]['inactive_time']*60)){
					// Se o ponto novo ta dentro do tempo de inativo inserta o ponto na mesma rota
					return $this->updateRoute($route[0]['id'],
											  $lat,
		  									  $lon);
				}else{
					// Se não, inserta o ponto numa nova rota
					$newidroute = $route[0]['idroute'] + 1;
					return $this->registrar($dt,
									$resMobile[0]['_id'],
									$newidroute,
									$lat,
									$lon);
				}*/
			}
		}	
	}
}
