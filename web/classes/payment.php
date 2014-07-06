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
    public $sequence;
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
            $this->sequence = $query['sequence'];
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

    function byCompany($fkcompany)
    {
        $result = $this->con->genericQuery("select * from " . $this->table . " where fk_company = '$fkcompany' order by sequence DESC limit 1");
        $query = $result[0];

        if (count($query) == 0){
            return false;
        }else {
            $this->id = $query['id'];
            $this->sequence = $query['sequence'];
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

    function getDashboardAccountStat($fkcompany){
        $result = $this->con->genericQuery("select month(date_start) AS `dateMonth`,u_mobile,u_web from " . $this->table . " where fk_company = '$fkcompany' ORDER BY date_start ASC limit 7");
        return $result;
    }

    function createFree($fk_company)
    {
        $dtS = date("Y-m-d");

        $stE = strtotime($dtS ."+ 30 days");
        $dtE = date("Y-m-d",$stE); 

        $dados["sequence"] = 1;
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

    function addUWeb()
    {   
        $sumUW = $this->u_web;
        $dadosA["id"] = $this->id;
        $dadosA["u_web"] = $sumUW + 1;
        return $this->con->update($this->table,$dadosA);
    }

    function delUWeb()
    {   
        $sumUW = $this->u_web;
        $dadosD["id"] = $this->id;
        if($sumUW > 0){
            $dadosD["u_web"] = $sumUW - 1;    
        }else{
            $dadosD["u_web"] = 0;  
        }
        return $this->con->update($this->table,$dadosD);
    }

    function getByDate($fk_company,$dtIni,$dtEnd){
        $query = $this->con->genericQuery("select * from " . $this->table . " where fk_company = {$fk_company} and (date_start between STR_TO_DATE('".$dtIni."','%m-%Y') and STR_TO_DATE('".$dtEnd."','%m-%Y')) order by date_start");
        $objReturn = array();

       foreach ($query as $value) {
            $py = new payment();
            $py->open($value);
            $objReturn[] = $py;
        }

        return $objReturn;

    }    
}