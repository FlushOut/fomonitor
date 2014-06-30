<?php require_once("../config.php");

$id = $_POST['id'];
switch ($_POST['source']) {
    case 'category':
        $obj = new category();
        $obj->open($id);
        $obj->del();
        break;
    case 'point':
        $obj = new point();
        $obj->open($id);
        $obj->del();
        break;
    case 'user':
        $obj = new user();
        $obj->open($id);
        $obj->del();
        $pay = new payment();
        $pay->paymentByCompany($company->id);
        $pay->delUWeb();
        break;
    default:
        # code...
        break;
}