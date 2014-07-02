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
    public $code_conf;
    public $name;
    public $email;
    public $password;
    public $status;
    public $status_conf;
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
        $us = NULL;

        $query = $this->con->genericQuery("select * from " . $this->table . " where status=1 and email='". $email ."' and password='" . $password . "'");

        if (count($query) == 0){
            return false;
        }
        else {
            $u = new user();
            $u->open($query[0]['id']);
            $us = $u;
        }

        return $us;
    }

     function open($query)
    {
        if(!is_array($query)){

            if(is_numeric($query))
                $result = $this->con->genericQuery("select * from " . $this->table . " where id = $query");    
            else
                $result = $this->con->genericQuery("select * from " . $this->table . " where email = '$query'");

            $query = $result[0];
                
        }
        if (count($query) == 0)
            return false;
        else {
            $this->id = $query['id'];
            $this->code_conf = $query['code_conf'];
            $this->name = $query['name'];
            $this->email = $query['email'];
            $this->status = $query['status'];
            $this->status_conf = $query['status_conf'];
            $this->fk_company = $query['fk_company'];

            $this->create_date = $query['create_date'];
            $this->create_user = $query['create_user'];
            $this->update_date = $query['update_date'];
            $this->update_user = $query['update_user'];

            $query_profiles = $this->con->genericQuery("select fk_profile from user_profiles 
                                                        where fk_user = " . $this->id);

            

            if (count($query_profiles) > 0) {
                foreach ($query_profiles as $value) {
                    array_push($this->profiles,$value['fk_profile']);
                }
            }

            return true;
        }
    }

    function save($fk_company, $name, $email,$password)
    {
        $now = new DateTime();
        $dadosS["fk_company"] = $fk_company;
        $dadosS["name"] = addslashes($name);
        $dadosS["email"] = addslashes($email);
        $dadosS["password"] = md5($password);
        $dadosS["create_date"] = addslashes($now->format('Y-m-d H:i:s'));
        $dadosS["status"] = 1;

        if ($this->id > 0) {
            $dadosS["id"] = $this->id;
            return $this->con->update($this->table,$dadosS);
        } else {
            return $this->con->insert($this->table,$dadosS);
        }
        
    }

    function saveProfiles($idUser, $profiles)
    {
        $query = "delete from user_profiles where fk_user=" . $idUser;
        $this->con->genericQuery($query);
        $first = true;
        foreach ($profiles as $value) {
            $first_prof = 0;
            if($first){
                $first_prof = 1;
                $first = false;
            }
            
            $query = "insert into user_profiles(fk_user,fk_profile,first_profile)
                      values(".$idUser.",".$value.",".$first_prof.")";
            $this->con->genericQuery($query);
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

    function list_profiles()
    {
        return $query = $this->con->genericQuery("select * from profiles where status = 1");        
    }

    function createAdmin($fk_company, $name, $email, $password)
    {
        $now = new DateTime();
        $dadosC["fk_company"] = $fk_company;
        $dadosC["name"] = addslashes($name);
        $dadosC["email"] = addslashes($email);
        $dadosC["password"] = md5($password);
        $dadosC["create_date"] = addslashes($now->format('Y-m-d H:i:s'));
        $dadosC["status"] = 1;
        $dadosC["status_conf"] = 0;

        $idUser = $this->con->insert($this->table,$dadosC);
        $admin = array(1); 
        $this->saveProfiles($idUser,$admin);

        return $idUser;
    }

    function vEmail($id, $code)
    {
        $query = $this->con->genericQuery("select * from " . $this->table . " where id=" . $id . " and code_conf=" . $code);
        if (count($query) == 0){
            return false;
        }else{
            $uv = NULL;
            $dadosV["id"] = $id;
            $dadosV["status_conf"] = 1;
            $up = $this->con->update($this->table,$dadosV);    
            if($up > 0){
                $objReturn = array();
                foreach ($query as $value) {
                    $user = new user();
                    $user->open($value);
                    $objReturn[] = $user;
                }
                return $objReturn[0];    
            }else{
                return false;
            }
        }
    }
    
    function sendCode($idUser, $email)
    {   

        $fromName = "FlushOut Contact";
        $fromEmail = "contact@flushoutsolutions.com";
        $code =  rand(1000,9999);

        $headers = "From: $fromName $fromEmail\r\n";
        $headers .= "X-Mailer: PHP5\n";
        $headers .= 'MIME-Version: 1.0' . "\n";
        $headers .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";
         
        $subject = "Code Confirmation";
        $body = "<strong>Code:</strong> ".$code."<br>";

        if ($email != '' && $code > 999){
            if (mail($email,$subject,$body,$headers)){
                $dadosSE["id"] = $idUser;
                $dadosSE["code_conf"] = $code;
                return $this->con->update($this->table,$dadosSE);        
            } else {
                return false;
            }
        } else {
            return false;
        }   
    }

    function verifExistsEmail($email)
    {
        $query = $this->con->genericQuery("select 1 from " . $this->table . " where email = '$email'");
        if (count($query) == 0){
            return 0;
        }else{
           return 1;
        }
    }

}