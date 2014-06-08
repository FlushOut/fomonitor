<?php
class company
{
    protected $table = "companies";

    public $id = 0;
    public $fk_country;
    public $name;
    public $code;
    public $gps_time;
    public $gps_distance;
    public $idle_time;
    public $bytes;
    public $inactive_time;
    public $logo;
    public $logo_type;
    public $status;

    public $create_date;
    public $create_user;
    public $update_date;
    public $update_user;

    function company(){
        $this->con = new DataBase();
    }

    function open($id)
    {
        $query = $this->con->genericQuery("select * from " . $this->table . " where id = '$id'");

        if (count($query) == 0)
            return false;
        else {
            $this->id = $query[0]['id'];
            $this->name = $query[0]['name'];
            $this->code = $query[0]['code'];
            $this->gps_time = $query[0]['gps_time'];
            $this->gps_distance = $query[0]['gps_distance'];
            $this->idle_time = $query[0]['idle_time'];
            $this->bytes = $query[0]['bytes'];
            $this->inactive_time = $query[0]['inactive_time'];
            $this->logo = $query[0]['logo'];
            $this->logo_type = $query[0]['logo_type'];
            $this->status = $query[0]['status'];
            
            return true;
        }
    }

    function save($name, $foto, $type, $gps_time, $gps_distance, $inactive_time, $idle_time)
    {
        $pont = fopen($foto, "rb");
        $fotoFinal = fread($pont,filesize($foto));
        fclose($pont);
        $fotoFinal = addslashes($fotoFinal);

        $dados["name"] = $name;
        $dados["logo"] = $fotoFinal;
        $dados["logo_type"] = $type;
        $dados["gps_time"] = $gps_time;
        $dados["gps_distance"] = $gps_distance;
        $dados["inactive_time"] = $inactive_time;
        $dados["idle_time"] = $idle_time;
        
        if ($this->id > 0) {
            $dados["id"] = $this->id;
            return $this->con->update($this->table,$dados);
        } else {
            return $this->con->insert($this->table,$dados);
        }
        
    }

}