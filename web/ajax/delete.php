<?php require_once("../config.php");

$id = $_POST['id'];
switch ($_POST['source']) {
    case 'category':
        $obj = new category();
        $obj->open($id);
        $obj->del();
        break;
    default:
        # code...
        break;
}