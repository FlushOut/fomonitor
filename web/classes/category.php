<?php
/**
 * Created by JetBrains PhpStorm.
 * User: manuel.moyano
 * Date: 17/09/13
 * Time: 10:35
 * To change this template use File | Settings | File Templates.
 */

class category
{

    protected $table = "categories";

    public $id = 0;
    public $fk_company;
    public $description;
    public $code;
    public $status;
  
    function category(){
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
            $this->description = $query['description'];
            $this->status = $query['status'];
            $this->code = $query['code'];
            return true;
        }
    }

    function save($fk_company, $description)
    {
        $dados["fk_company"] = $fk_company;
        $dados["description"] = addslashes($description);
        $dados["code"] = substr(strtoupper($description),0,1). substr(strtoupper($description), -1) . rand(100, 999); 
        $dados["status"] = 1;
        
        if ($this->id > 0) {
            $dados["id"] = $this->id;
            return $this->con->update($this->table,$dados);
        } else {
            return $this->con->insert($this->table,$dados);
        }
        
    }

    function list_categories($fk_company)
    {
        $query = $this->con->genericQuery("select * from " . $this->table . " where fk_company = '$fk_company'");

        $objReturn = array();

        foreach ($query as $value) {
            $category = new category();
            $category->open($value);
            $objReturn[] = $category;
        }

        return $objReturn;
    }

    function del()
    {
        $query = $this->con->genericQuery("delete from " . $this->table . " where id=" . $this->id);
    }
}