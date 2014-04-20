<?php
/**
 * Created by JetBrains PhpStorm.
 * User: manuel.moyano
 * Date: 17/09/13
 * Time: 10:35
 * To change this template use File | Settings | File Templates.
 */

class status
{
    $arrayEN = array(
    "1" => "In use",
    "2" => "Idle",
    "3" => "Broken",
    "4" => "Stolen",
    "5" => "Lost"
    );

    $arrayPT = array(
    "1" => "Em uso",
    "2" => "Ocioso",
    "3" => "Defeituoso",
    "4" => "Roubado",
    "5" => "Desaparecido"
    );

    $arrayES = array(
    "1" => "En uso",
    "2" => "En desuso",
    "3" => "Descompuesto",
    "4" => "Robado",
    "5" => "Desaparecido"
    );

    function listByLang($lang)
    {
        switch ($lang) {
            case 'en':
                return $arrayEN;
                break;
            case 'pt':
                return $arrayPT;
                break;
            case 'es':
                return $arrayES;
                break;
        }
    }
}
