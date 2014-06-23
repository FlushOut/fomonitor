<?php
/**
 * Created by JetBrains PhpStorm.
 * User: john borrego
 * Date: 16/04/14
 * Time: 22.30
 * To change this template use File | Settings | File Templates.
 */

class point
{

    protected $table = "points";

    public $id = 0;
    public $id_company;
    public $name;
    public $addr_street;
    public $addr_number;
    public $addr_district;
    public $addr_city;
    public $addr_state;
    public $addr_postalcode;
    public $latitude;
    public $longitude;
    public $radius;
  
    function point(){
        $this->con = new DataBase();
    }

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
            $this->id_company = $query['id_company'];
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

    function save($id_company, $name, $addr_street, $addr_number, $addr_district, $addr_city, $addr_state, $addr_postalcode, $latitude, $longitude, $radius)
    {
        $dados["id_company"] = $id_company;
        $dados["name"] = addslashes($name);
        $dados["addr_street"] = addslashes($addr_street);
        $dados["addr_number"] = addslashes($addr_number);
        $dados["addr_district"] = addslashes($addr_district);
        $dados["addr_city"] = addslashes($addr_city);
        $dados["addr_state"] = addslashes($addr_state);
        $dados["addr_postalcode"] = addslashes($addr_postalcode);
        $dados["latitude"] = $latitude;
        $dados["longitude"] = $longitude;
        $dados["radius"] = $radius;

       if ($this->id > 0) {
            $dados["id"] = $this->id;
            return $this->con->update($this->table,$dados);
        } else {
            return $this->con->insert($this->table,$dados);
        }
    }

    function list_points($id_company)
    {
        $query = $this->con->genericQuery("select * from " . $this->table . " where id_company = '$id_company'");

        $objReturn = array();

        foreach ($query as $value) {
            $point = new point();
            $point->open($value);
            $objReturn[] = $point;
        }

        return $objReturn;
    }

    function list_pointsById($idPoints)
    {
        $query = $this->con->genericQuery("select * from " . $this->table . " where id in ({$idPoints})");

        $objReturn = array();

        foreach ($query as $value) {
            $point = new point();
            $point->open($value);
            $objReturn[] = $point;
        }

        return $objReturn;
    }

    function del()
    {
        $query = $this->con->genericQuery("delete from " . $this->table . " where id=" . $this->id);
    }
}