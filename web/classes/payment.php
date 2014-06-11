<?php
/**
 * Created by JetBrains PhpStorm.
 * User: manuel.moyano
 * Date: 17/09/13
 * Time: 10:35
 * To change this template use File | Settings | File Templates.
 */

class payment
{

    protected $table = "payment";

    public $id = 0;
    public $fk_company;
    public $date_start;
    public $date_end;
    public $u_mobile;
    public $u_web;
    public $type;
    public $status;
  
    function payment(){
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
            $this->fk_company = $query['fk_company'];
            $this->date_start = $query['date_start'];
            $this->date_end = $query['date_end'];
            $this->u_mobile = $query['u_mobile'];
            $this->u_web = $query['u_web'];
            $this->type = $query['type'];
            $this->status = $query['status'];
            return true;
        }
    }

    function createFree($fk_company)
    {
        $dtS = date("Y-m-d");

        $stE = strtotime($dtS ."+ 30 days");
        $dtE = date("Y-m-d",$stE); 

        $dados["fk_company"] = $fk_company;
        $dados["date_start"] = addslashes($dtS);
        $dados["date_end"] = addslashes($dtE);
        $dados["u_mobile"] = 0;
        $dados["u_web"] = 1;
        $dados["type"] = "F";
        $dados["status"] = 1;

        $idPayment = $this->con->insert($this->table,$dados);
        return $idPayment; 

        
    }

}