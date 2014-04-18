<?php
/**
 * Created by JetBrains PhpStorm.
 * User: manuel.moyano
 * Date: 17/09/13
 * Time: 10:35
 * To change this template use File | Settings | File Templates.
 */

class user
{

    protected $table = "users";

    public $id = 0;
    public $name;
    public $email;
    public $password;
    public $status;
    public $fk_company;

    public $create_date;
    public $create_user;
    public $update_date;
    public $update_user;
    public $profiles = array();

    function user(){
        $this->con = new DataBase();
    }

    function login($email, $password)
    {
        $email = addslashes($email);
        $password = md5($password);

        $query = $this->con->genericQuery("select * from " . $this->table . " where status=1 and email='$email' and password='" . $password . "'");
        if (count($query) == 0)
            return false;
        else {
            return $query[0]['id'];
        }
    }

     function open($query)
    {
        if(!is_array($query)){

            if(is_numeric($query))
                $result = $this->con->genericQuery("select * from " . $this->table . " where id = '$query'");    
            else
                $result = $this->con->genericQuery("select * from " . $this->table . " where email = '$query'");

            $query = $result[0];
                
        }
        if (count($query) == 0)
            return false;
        else {
            $this->id = $query['id'];
            $this->name = $query['name'];
            $this->email = $query['email'];
            $this->status = $query['status'];
            $this->fk_company = $query['fk_company'];

            $this->create_date = $query['create_date'];
            $this->create_user = $query['create_user'];
            $this->update_date = $query['update_date'];
            $this->update_user = $query['update_user'];

            return true;
        }
    }

    function save($fk_company, $name, $email,$password)
    {
        $dados["fk_company"] = $fk_company;
        $dados["name"] = addslashes($name);
        $dados["email"] = addslashes($email);
        $dados["password"] = md5($password);
        $dados["status"] = 1;

       
        if ($this->id > 0) {
            $dados["id"] = $this->id;
            return $this->con->update($this->table,$dados);
        } else {
            return $this->con->insert($this->table,$dados);
        }
        
    }

    function list_users($fk_company)
    {
        $query = $this->con->genericQuery("select * from " . $this->table . " where fk_company = '$fk_company'");

        $objReturn = array();

        foreach ($query as $value) {
            $user = new user();
            $user->open($value);
            $objReturn[] = $user;
        }

        return $objReturn;
    }

    function del()
    {
        $query = $this->con->genericQuery("delete from " . $this->table . " where id=" . $this->id);
    }

}