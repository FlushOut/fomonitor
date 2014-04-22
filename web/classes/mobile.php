<?php
/**
 * Created by JetBrains PhpStorm.
 * User: manuel.moyano
 * Date: 17/09/13
 * Time: 10:35
 * To change this template use File | Settings | File Templates.
 */

class mobile
{

    protected $table = "mobiles";

    public $id = 0;
    public $imei;
    public $fk_status;
    public $fk_category;
    public $fk_company;
    public $manufacturer;
    public $model;
    public $warranty;
    public $name;
    public $contact;
    public $email;
    public $password;
    public $status;
    public $create_date;
    public $last_update;

  
    function mobile(){
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
            $this->imei = $query['imei'];
            $this->fk_status = $query['fk_status'];
            $this->fk_category = $query['fk_category'];
            $this->fk_company = $query['fk_company'];
            $this->manufacturer = $query['manufacturer'];
            $this->model = $query['model'];
            $this->warranty = $query['warranty'];
            $this->name = $query['name'];
            $this->contact = $query['contact'];
            $this->email = $query['email'];
            $this->password = $query['password'];
            $this->status= $query['status'];
            $this->create_date = $query['create_date'];
            $this->last_update = $query['last_update'];

            return true;
        }
    }

    function openByImei($query)
    {
        if(!is_array($query)){
        	$result = $this->con->genericQuery("select * from " . $this->table . " where imei = '$query'");
            $query = $result[0];
        }

        if (count($query) == 0)
            return false;
        else {
            $this->id = $query['id'];
            $this->imei = $query['imei'];
            $this->fk_status = $query['fk_status'];
            $this->fk_category = $query['fk_category'];
            $this->fk_company = $query['fk_company'];
            $this->manufacturer = $query['manufacturer'];
            $this->model = $query['model'];
            $this->warranty = $query['warranty'];
            $this->name = $query['name'];
            $this->contact = $query['contact'];
            $this->email = $query['email'];
            $this->password = $query['password'];
            $this->status= $query['status'];
            $this->create_date = $query['create_date'];
            $this->last_update = $query['last_update'];

            return true;
        }
    }

    function list_mobile($fk_company)
    {
        $query = $this->con->genericQuery("select * from " . $this->table . " where fk_company = '$     fk_company' order by name asc");
        $objReturn = array();


       foreach ($query as $value) {
            $mob = new mobile();
            $mob->open($value);

            $objReturn[] = $mob;
        }

        return $objReturn;
    }

    function getLastData($fk_company){
        $query = $this->con->genericQuery("
            SELECT
                `ultima_pos`.`idMobil`,
                `ultima_pos`.`imeiMobil`,
                `ultima_pos`.`name`,
                `mobile_data`.`latitude`,
                `mobile_data`.`longitude`,
                `mobile_data`.`batterylevel`,
                `mobile_data`.`gsmstrength`,
                `mobile_data`.`accuracy`,
                `mobile_data`.`speed`,
                `ultima_pos`.`date`
            FROM
                (
                    SELECT
                        STRAIGHT_JOIN Max(`mobile_data`.`id`) AS `id`,
                        Max(`mobile_data`.`date`) AS `date`,
                        `mobiles`.`id` AS `idMobil`,
                        `mobiles`.`imei` AS `imeiMobil`,
                        `mobiles`.`name`
                    FROM
                        `mobiles`
                            INNER JOIN
                                `mobile_data`
                                    ON
                                        `mobiles`.`imei` = `mobile_data`.`imei`
                    WHERE
                        `mobiles`.`fk_company` = {$fk_company}
                    GROUP BY
                        `mobile_data`.`imei`
                ) `ultima_pos`
                    INNER JOIN
                        `mobile_data`
                            ON
                                `mobile_data`.`id` = `ultima_pos`.`id`
            ORDER BY
                `ultima_pos`.`name`");

        if (count($query) == 0)
        {
            return false;
        }
        else 
        { 

            foreach ($query as $value) {
                $md = new mobile_dataL;
                $md->id = $value['idMobil'];
                $md->imei = $value['imeiMobil'];
                $md->name = $value['name'];
                $md->latitude = $value['latitude'];
                $md->longitude = $value['longitude'];
                $md->batterylevel = $value['batterylevel'];
                $md->gsmstrength = $value['gsmstrength'];
                $md->accuracy = $value['accuracy'];
                $md->speed = $value['speed'];
                $md->date = $value['date'];

                 if ($md->gsmstrength == 99 || $md->gsmstrength < 5)
                    $md->gsm_strength_param = 0;
                elseif ($md->gsmstrength >= 5 && $md->gsmstrength < 10)
                    $md->gsm_strength_param = 1; elseif ($md->gsmstrength >= 10 && $md->gsmstrength < 15)
                    $md->gsm_strength_param = 2; elseif ($md->gsmstrength >= 15 && $md->gsmstrength < 20)
                    $md->gsm_strength_param = 3; elseif ($md->gsmstrength >= 20 && $md->gsmstrength < 25)
                    $md->gsm_strength_param = 4; else
                    $md->gsm_strength_param = 5;

                $objReturn[] = $md;
            }
            return $objReturn;
        }
    }

    public function getSettings() {
        
        return $this->con->genericQuery(" select imei, wifi, screen, localsafety, apps, accounts, privacy, storage, keyboard, voice, accessibility, about from mobile_settings where imei='" . $this->imei . "'");
    }

    public function getSettingsImei($imei) {
        
        return $this->con->genericQuery(" select imei, wifi, screen, localsafety, apps, accounts, privacy, storage, keyboard, voice, accessibility, about from mobile_settings where imei='" . $imei . "'");
    }

    function setSettings($options)
    {
        $wifi = '0';
        $screen = '0';
        $localsafety = '0';
        $apps = '0';
        $accounts = '0';
        $privacy = '0';
        $storage = '0';
        $keyboard = '0';
        $voice = '0';
        $accessibility = '0';
        $about = '0';

        if (isset($options['wifichk'])) $wifi = '1';
        if (isset($options['screenchk'])) $screen = '1';
        if (isset($options['localsafetychk'])) $localsafety = '1';
        if (isset($options['appschk'])) $apps = '1';
        if (isset($options['accountschk'])) $accounts = '1';
        if (isset($options['privacychk'])) $privacy = '1';
        if (isset($options['storagechk'])) $storage = '1';
        if (isset($options['keyboardchk'])) $keyboard = '1';
        if (isset($options['voicechk'])) $voice = '1';
        if (isset($options['accessibilitychk'])) $accessibility = '1';
        if (isset($options['aboutchk'])) $about = '1';



        $query = "update mobile_settings set wifi=" . $wifi . ", screen=" . $screen . ", localsafety=" . $localsafety . ", apps=" . $apps . ", accounts=" . $accounts . ", privacy=" . $privacy . ", storage=" . $storage . ", keyboard=" . $keyboard . ", voice=" . $voice . ", accessibility=" . $accessibility . ", about=" . $about . " where imei='" . $this->imei . "'";
        $this->con->genericQuery($query);

    }

    function setApps($apps)
    {

        $query = "update mobile_applications set allowed=0 where imei='" . $this->imei . "'";
        $this->con->genericQuery($query);

        foreach ($apps as $value) {
            $query = "update mobile_applications set allowed=1 where id='" . $value . "'";
            $this->con->genericQuery($query);
        }
    }

    function getApps()
    {
        $query = $this->con->genericQuery("select * from mobile_applications where imei = '" . $this->imei . "' order by name asc");
        return $query;
    }

    function getAppsImei($imei)
    {
        $query = $this->con->genericQuery("select * from mobile_applications where imei = '" . $imei . "' order by name asc");
        return $query;
    }

    function update($fk_status, $fk_category, $warranty, $name, $contact, $email, $password)
    {
        if(isset($fk_status)) $dados["fk_status"] = $fk_status;
        if(isset($fk_category)) $dados["fk_category"] = $fk_category;
        if(strlen($warranty)>0) {
        	$t = strtotime($warranty);
        	$dados["warranty"] = date('Y-m-d H:i:s',$t);
        }
        if(strlen($name)>0) $dados["name"] = $name;
        if(strlen($contact)>0) $dados["contact"] = $contact;
        if(strlen($email)>0) $dados["email"] = $email;
        if(strlen($password)>0) $dados["password"] = $password;

        if(isset($dados)) {
            $date = date('Y-m-d H:i:s');
            $dados["id"] = $this->id;
            $dados["last_update"] = $date;
            return $this->con->update($this->table,$dados);    
        }
        
    }
}
