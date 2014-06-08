<?php
/**
 * Created by JetBrains PhpStorm.
 * User: manuel.moyano
 * Date: 17/09/13
 * Time: 10:35
 * To change this template use File | Settings | File Templates.
 */

class dashboard
{

    function dashboard(){
        $this->con = new DataBase();
    }

    function getLastData($fk_company){
        $query = $this->con->genericQuery("
            SELECT
                `ultima_pos`.`idMobil`,
                `ultima_pos`.`name`,    
                `mobile_data`.`batterylevel`,
                `mobile_data`.`gsmstrength`,
                `mobile_data`.`speed`,
                `ultima_pos`.`date`
            FROM
                (
                    SELECT
                        STRAIGHT_JOIN Max(`mobile_data`.`id`) AS `id`,
                        Max(`mobile_data`.`date`) AS `date`,
                        `mobiles`.`id` AS `idMobil`,
                        `mobiles`.`name`
                    FROM
                        `mobiles`
                            INNER JOIN
                                `mobile_data`
                                    ON
                                        `mobiles`.`id` = `mobile_data`.`fk_mobile`
                    WHERE
                        `mobiles`.`fk_company` = {$fk_company}
                    GROUP BY
                        `mobile_data`.`fk_mobile`
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
                $md->name = $value['name'];
                $md->batterylevel = $value['batterylevel'];
                $md->gsmstrength = $value['gsmstrength'];
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
    
    
    
    function format_date($strDate)
    {
        $Y = substr($strDate, 0, 4);
        $m = substr($strDate, 5, 2);
        $d = substr($strDate, 8, 2);

        $G = substr($strDate, 11, 2);
        $i = substr($strDate, 14, 2);
        $s = substr($strDate, 17, 2);

        return "$d/$m/$Y at $G:$i:$s";
    }

    function get_manufacturer_count($fk_company){
        $query = $this->con->genericQuery(
        "
            SELECT
                manufacturer,
                COUNT(*) AS 'qntd'
            FROM
                mobiles
            WHERE
                fk_company = {$fk_company}

            GROUP BY
                manufacturer
        "
        );

        return $query;
    }

    function get_model_count($fk_company){
        $query = $this->con->genericQuery(
            "
            SELECT
                model,
                COUNT(*) AS 'qntd'
            FROM
                mobiles
            WHERE
                fk_company = {$fk_company}
            GROUP BY
                model
        "
        );

        return $query;
    }

    function get_category_count($fk_company){
        $query = $this->con->genericQuery(

            "
            SELECT
               categories.description AS category,
               COUNT(*) AS qntd
            FROM
               mobiles
               INNER JOIN categories ON mobiles.fk_category = categories.id
            WHERE
               mobiles.fk_company = {$fk_company}
            GROUP BY categories.description"
        );

        return $query;
    }

    function get_status_count($fk_company){
        $query = $this->con->genericQuery(

            "
            SELECT
               CASE fk_status when 1 then 'In use'
                      when 2 then 'Idle'
                      when 3 then 'Broken'
                      when 4 then 'Stolen'
                      ELSE 'Lost' END,
               COUNT(*) AS qntd
            FROM
               mobiles
            WHERE
               mobiles.fk_company = {$fk_company}
            GROUP BY fk_status"
        );

        return $query;
    }

}

