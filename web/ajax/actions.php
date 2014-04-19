<?php require_once("../config.php");

$id = $_POST['id'];
switch ($_POST['action']) {
	case 'getProfiles':
		getProfiles($id);
		break;
	default:
        # code...
        break;

}
function getProfiles($idUser){
		$user = new user();
		$html = "";
		$user->open($idUser);
		$list_profiles = $user->list_profiles();
        foreach ($list_profiles as $item) {
        	$html.= '<label class="checkbox">';
        	$html.= '<input type="checkbox" data-form="uniform" name="prof[]" value="'.$item['id'].'"';
        	foreach($user->profiles as $p){
                if ($item['id'] == $p) { 
                	$html.=	' checked ';
                    } 
            } 
        	$html.=' />';
        	$html.= $item['description'];
        	$html.= '</label>';
        }
        echo $html;
}