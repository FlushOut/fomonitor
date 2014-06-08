<?php
/**
 * Created by JetBrains PhpStorm.
 * User: manuel.moyano
 * Date: 17/09/13
 * Time: 10:35
 * To change this template use File | Settings | File Templates.
 */

class stay
{
    protected $table = "stay_point";

    public $id = 0;
    public $fk_user;
    public $user;
    public $fk_company;
    public $fk_point;
    public $point;
    public $date_in;
    public $date_out;
    public $time_permanence;
    public $last_location_type;

    function stay(){
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
            $this->fk_user = $query['fk_user'];
            $this->user = $query['user'];
            $this->fk_company = $query['fk_company'];
            $this->fk_point = $query['fk_point'];
            $this->point = $query['point'];
            $this->date_in = $query['date_in'];
            $this->date_out = $query['date_out'];
            $this->time_permanence = $query['time_permanence'];
            $this->last_location_type = $query['last_location_type'];

            return true;
        }
    }

    function getByDate($fk_company,$dtIni,$dtEnd){
        $query = $this->con->genericQuery("select * from stay_point where fk_company = {$fk_company} and (date_in between STR_TO_DATE('".$dtIni."','%d-%m-%Y') and STR_TO_DATE('".$dtEnd."','%d-%m-%Y')) order by date_in");

        $objReturn = array();

       foreach ($query as $value) {
            $st = new stay();
            $st->open($value);

            $objReturn[] = $st;
        }

        return $objReturn;

    }    
}

