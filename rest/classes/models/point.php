<?php
/**
 * poi.php, model para a tabela presence
 * 
 * @author Manuel Moyano <mnlmoyano@gmail.com>
 */
class point extends superModel {
	
	protected $table = 'points';


	 function open($query)
    {
        if(!is_array($query)){
            $result = $this->con->genericQuery("select * from " . $this->table . " where id = '$query'");
            $query = $result[0];
        }

        if (count($query) == 0)
            return false;
        else {
            $this->id = $query['id'];
            $this->fk_company = $query['fk_company'];
            $this->name = $query['name'];
            $this->addr_street = $query['addr_street'];
            $this->addr_number = $query['addr_number'];
            $this->addr_district = $query['addr_district'];
            $this->addr_city = $query['addr_city'];
            $this->addr_state = $query['addr_state'];
            $this->addr_postalcode = $query['addr_postalcode'];
            $this->latitude = $query['latitude'];
            $this->longitude = $query['longitude'];
            $this->radius = $query['radius'];

            return true;
        }
    }


 	function list_point($fk_company)
    {
        $query = $this->genericQuery("select * from " . $this->table . " where id_company = '$fk_company'");

        $objReturn = array();

        foreach ($query as $value) {
            $point = new point();
            $point->open($value);
            $objReturn[] = $point;
        }

        return $objReturn;
    }
	
}