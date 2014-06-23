<?php require_once("../config.php");

if (isset($_POST['id'])) $id = $_POST['id'];
if (isset($_POST['idUsers'])) $idUsers = $_POST['idUsers'];
if (isset($_POST['idPoints'])) $idPoints = $_POST['idPoints'];
if (isset($_POST['dtStart'])) $dtStart = $_POST['dtStart'];
if (isset($_POST['dtEnd'])) $dtEnd = $_POST['dtEnd'];
if (isset($_POST['dt'])) $dt = $_POST['dt'];
if (isset($_POST['idletime'])) $idletime = $_POST['idletime'];
if (isset($_POST['inactivetime'])) $inactivetime = $_POST['inactivetime'];
if (isset($_POST['data'])) $data = $_POST['data'];

switch ($_POST['action']) {
	case 'getProfiles':
		getProfiles($id);
		break;
	case 'getSettings':
		getSettings($id);
		break;
	case 'getApps':
		getApps($id);
		break;
	case 'getUserMap':
		getUserMap($id);
		break;
	case 'getDetailstoUpdate':
		getDetailstoUpdate($id);
		break;
	case 'getDetails':
		getDetails($id);
		break;
    case 'getUsersByCategory':
        getUsersByCategory($id);
        break;
    case 'showUsersPointsInMap':
        showUsersPointsInMap($idUsers,$idPoints,$idletime,$inactivetime);
        break;
    case 'showRoutesPointsInMap':
        showRoutesPointsInMap($idUsers,$idPoints,$dtStart,$dtEnd);
        break;
    case 'getUnlockCode':
        getUnlockCode($data);
        break;
    case 'getRouteByIdDt':
        getRouteByIdDt($id,$dt);
        break;
    case 'getLastDataByIdCompany':
        getLastDataByIdCompany($company->id);
        break;
    case 'showStaysByDate':
        showStaysByDate($company->id,$dtStart,$dtEnd);
        break;
    case 'getDashboardAccountStat':
        getDashboardAccountStat($company->id);
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

function getSettings($id){
		$mobile = new mobile();
		$html = "";
		$list_settings = $mobile->getSettingsId($id);

    	$html.= '<label class="checkbox">';
    	$html.= '<input type="checkbox" data-form="uniform" name="wifichk" value="t"'; 
    	if ($list_settings[0]['wifi'] == 1)
    		$html.= ' checked ';
    	$html.=' />Wifi';
    	$html.= '</label>';

    	$html.= '<label class="checkbox">';
    	$html.= '<input type="checkbox" data-form="uniform" name="screenchk" value="t"'; 
    	if ($list_settings[0]['screen'] == 1)
    		$html.= ' checked ';
    	$html.=' />Screen';
    	$html.= '</label>';

    	$html.= '<label class="checkbox">';
    	$html.= '<input type="checkbox" data-form="uniform" name="localsafetychk" value="t"'; 
    	if ($list_settings[0]['localsafety'] == 1)
    		$html.= ' checked ';
    	$html.=' />Local Safety';
    	$html.= '</label>';

    	$html.= '<label class="checkbox">';
    	$html.= '<input type="checkbox" data-form="uniform" name="appschk" value="t"'; 
    	if ($list_settings[0]['wifi'] == 1)
    		$html.= ' checked ';
    	$html.=' />Apps';
    	$html.= '</label>';

    	$html.= '<label class="checkbox">';
    	$html.= '<input type="checkbox" data-form="uniform" name="accountschk" value="t"'; 
    	if ($list_settings[0]['accounts'] == 1)
    		$html.= ' checked ';
    	$html.=' />Accounts';
    	$html.= '</label>';

    	$html.= '<label class="checkbox">';
    	$html.= '<input type="checkbox" data-form="uniform" name="privacychk" value="t"'; 
    	if ($list_settings[0]['privacy'] == 1)
    		$html.= ' checked ';
    	$html.=' />Privacy';
    	$html.= '</label>';

    	$html.= '<label class="checkbox">';
    	$html.= '<input type="checkbox" data-form="uniform" name="storagechk" value="t"'; 
    	if ($list_settings[0]['storage'] == 1)
    		$html.= ' checked ';
    	$html.=' />Storage';
    	$html.= '</label>';

    	$html.= '<label class="checkbox">';
    	$html.= '<input type="checkbox" data-form="uniform" name="keyboardchk" value="t"'; 
    	if ($list_settings[0]['keyboard'] == 1)
    		$html.= ' checked ';
    	$html.=' />Keyboard';
    	$html.= '</label>';

    	$html.= '<label class="checkbox">';
    	$html.= '<input type="checkbox" data-form="uniform" name="voicechk" value="t"'; 
    	if ($list_settings[0]['voice'] == 1)
    		$html.= ' checked ';
    	$html.=' />Voice';
    	$html.= '</label>';

    	$html.= '<label class="checkbox">';
    	$html.= '<input type="checkbox" data-form="uniform" name="accessibilitychk" value="t"'; 
    	if ($list_settings[0]['accessibility'] == 1)
    		$html.= ' checked ';
    	$html.=' />Accessibility';
    	$html.= '</label>';

    	$html.= '<label class="checkbox">';
    	$html.= '<input type="checkbox" data-form="uniform" name="aboutchk" value="t"'; 
    	if ($list_settings[0]['about'] == 1)
    		$html.= ' checked ';
    	$html.=' />About';
    	$html.= '</label>';

        echo $html;
}

function getApps($id){
		$mobile = new mobile();
		$html = "";
		$list_apps = $mobile->getAppsId($id);

    	foreach ($list_apps as $item) {
	    	$html.= '<label class="checkbox">';
	    	$html.= '<input type="checkbox" data-form="uniform" name="app[]" value="'.$item['id'].'"'; 
	    	if ($item['allowed'] == 1)
	    		$html.= ' checked ';
	    	$html.=' />'.$item['name'];
	    	$html.= '</label>';
	    }
        echo $html;
}

function getDetails($id){
		$mobile = new mobile();
		$html = "";
		$mobile->open($id);
		$status = new status();
		$list_status = $status->getByLang('en');
		$category = new category();
		$list_categories = $category->list_categories(1);

		$html.= '<div class="control-group">';
	    $html.= '<label class="control-label"><b>Name : <b></label>';
	    $html.= '<label class="control-label">'.$mobile->name.'</label>';
		$html.= '</div>';

		$html.= '<div class="control-group">';
	    $html.= '<label class="control-label"><b>Email : <b></label>';
	    $html.= '<label class="control-label">'.$mobile->email.'</label>';
		$html.= '</div>';

		$html.= '<div class="control-group">';
	    $html.= '<label class="control-label"><b>Contact : <b></label>';
	    $html.= '<label class="control-label">'.$mobile->contact.'</label>';
		$html.= '</div>';

		$html.= '<div class="control-group">';
	    $html.= '<label class="control-label"><b>Category : <b></label>';

	    		foreach($list_categories as $item)
        			if($mobile->fk_category == $item->id)
        				$html.= '<label class="control-label">'.$item->description.'</label>';
		$html.= '</div>';

		$html.= '<div class="control-group">';
	    $html.= '<label class="control-label"><b>Status : <b></label>';
	    		foreach($list_status as $key=>$item)
        			if($mobile->fk_status == $key)
        				$html.= '<label class="control-label">'.$item.'</label>';
		$html.= '</div>';

		$html.= '<div class="control-group">';
	    $html.= '<label class="control-label"><b>Warranty : <b></label>';
	    $html.= '<label class="control-label">'.$mobile->warranty.'</label>';
		$html.= '</div>';
	    
        echo $html;
}

function getUnlockCode($email){
        $mobile = new mobile();
        $html = "";
        $html.= '<div class="control-group">';
        $html.= '<label class="control-label"><b>Unlock Code :<b> </label>';
        $html.= '<label class="control-label">'.$mobile->getUnlockCode($email).'</label>';
        $html.= '</div>';
        
        echo $html;
}

function getDetailstoUpdate($id){
		$mobile = new mobile();
		$html = "";
		$mobile->open($id);
		$status = new status();
		$list_status = $status->getByLang('en');
		$category = new category();
		$list_categories = $category->list_categories($mobile->fk_company);

        $html.= '<div class="control-group">';
        $html.=     '<label class="control-label" for="txtName">Name</label>';
        $html.=     '<div class="controls">';
		$html.=         '<input type="text" id="txtName" name="txtName" value="'.$mobile->name.'" class="grd-white" 
								data-validate="{required: false}" />';
        $html.=     '</div>';
        $html.= '</div>';

        $html.= '<div class="control-group">';
        $html.=     '<label class="control-label" for="txtEmail">Email</label>';
        $html.=     '<div class="controls">';
		$html.=         '<input type="text" id="txtEmail" name="txtEmail" value="'.$mobile->email.'" class="grd-white" 
								data-validate="{required: false, email:true, messages:{email:&#39;Please enter a valid email address&#39;}}" />';
        $html.=     '</div>';
        $html.= '</div>';

        $html.= '<div class="control-group">';
        $html.=     '<label class="control-label" for="txtPassword">Password</label>';
        $html.=     '<div class="controls">';
		$html.=			'<input type="password" id="txtPassword" name="txtPassword" class="grd-white" data-validate="{required: false}" name="password" id="password" />';
        $html.=     '</div>';
        $html.= '</div>';

        $html.= '<div class="control-group">';
        $html.=     '<label class="control-label" for="txtContact">Contact</label>';
        $html.=     '<div class="controls">';
		$html.=         '<input type="text" id="txtContact" name="txtContact" value="'.$mobile->contact.'" class="grd-white" 
								data-validate="{required: false}" />';
        $html.=     '</div>';
        $html.= '</div>';

        $html.= '<div class="control-group">';
        $html.=     '<label class="control-label" for="cboCategory">Category</label>';
        $html.=     '<div class="controls">';
		$html.=         '<select id="cboCategory" name="cboCategory" style="width:220px"">';
                            foreach($list_categories as $item){
        						if($mobile->fk_category == $item->id){
        							$html.= '<option value="'.$item->id.'" selected>'.$item->description.'</option>';		
        						}else{
        							$html.= '<option value="'.$item->id.'">'.$item->description.'</option>';			
        						}
							}
        $html.=         '</select>';
        $html.=     '</div>';
        $html.= '</div>';

        $html.= '<div class="control-group">';
        $html.=     '<label class="control-label" for="cboStatus">Status</label>';
        $html.=     '<div class="controls">';
        $html.=         '<select id="cboStatus" name="cboStatus" style="width:220px">';
        					foreach($list_status as $key=>$item){
        						if($mobile->fk_status == $key){
        							$html.= '<option value="'.$key.'" selected>'.$item.'</option>';		
        						}else{
        							$html.= '<option value="'.$key.'">'.$item.'</option>';			
        						}
							}
        $html.=         '</select>';
        $html.=     '</div>';
        $html.= '</div>';

        $html.= '<div class="control-group">';
        $html.=     '<label class="control-label" for="txtWarranty">Warranty</label>';
        $html.=     '<div class="controls">';
		$html.=         '<input type="text" id="txtWarranty" name="txtWarranty" value="'.$mobile->warranty.'" class="grd-white" 
								data-validate="{required: false, date:true, messages:{date:&#39;Please enter a valid date&#39;}}" />';
        $html.=     '</div>';
        $html.= '</div>';
	    
        echo $html;
}

function getUsersByCategory($fk_category){
        $mobile = new mobile();
        $objReturn = array();
        $list_mobile = $mobile->list_mobileByCategory($fk_category);
        foreach ($list_mobile as $value) {
            $mob = new mobileMap();
            $mob->id = $value['id'];
            $mob->name = $value['name'];
            $objReturn[] = $mob;
        }
        echo json_encode($objReturn);
}

function showUsersPointsInMap($idUsers,$idPoints,$idletime,$inactivetime){
    $users = (string)$idUsers;
    if (substr($users, 0, strpos($users, ',')) == 'data')
        $users = substr($users, strpos($users, ",") + 1);   

    $points = implode(",", $idPoints);
    $data = array();
    $mobile = new mobile();
    $data['users'] = $mobile->getLastDataByIds($users,$idletime,$inactivetime);

    $point = new point();
    $data['points'] = $point->list_pointsById($points);

    echo json_encode($data);
}

function showRoutesPointsInMap($idUsers,$idPoints,$dtStart,$dtEnd){

    $users = (string)$idUsers;
    if (substr($users, 0, strpos($users, ',')) == 'data')
        $users = substr($users, strpos($users, ",") + 1);   

    $points = implode(",", $idPoints);
    $data = array();
    $mobile = new mobile();
    $data['routes'] = $mobile->getRoutesByIdsData($users,$dtStart,$dtEnd);


    $point = new point();
    $data['points'] = $point->list_pointsById($points);

    echo json_encode($data);
}

function getRouteByIdDt($id,$dt){

    $mobile = new mobile();
    $mobile->open($id);
    $data['route'] = $mobile->getRoutesByIdsDataOne($id,$dt,$dt);
    $data['mobile'] = $mobile;

    $objReturn = array();
    $list_mobile = $mobile->list_mobileByCategory($mobile->fk_category);
    foreach ($list_mobile as $value) {
        $mob = new mobileMap();
        $mob->id = $value['id'];
        $mob->name = $value['name'];
        $objReturn[] = $mob;
    }
    $data['mobiles'] = $objReturn;

    echo json_encode($data);
}

function getLastDataByIdCompany($fk_company){
    
    $data = array();
    $dashboard = new dashboard();
    $data['users'] = $dashboard->getLastData($fk_company);
    echo json_encode($data);
}

function getDashboardAccountStat($fk_company){
    $data = array();
    $payment = new payment();
    $data = $payment->getDashboardAccountStat($fk_company);
    echo json_encode($data);
}

function showStaysByDate($fk_company,$dtStart,$dtEnd){

    $stay = new stay();
    $list_stays = $stay->getByDate($fk_company,$dtStart,$dtEnd);
    $html.= '<table id="datatables" class="table table-bordered table-striped responsive">';
    $html.= '   <thead>';
    $html.= '       <tr>';
    $html.= '           <th class="head0">User</th>';
    $html.= '           <th class="head1">Point</th>';
    $html.= '           <th class="head0">Date In</th>';
    $html.= '           <th class="head0">Date Out</th>';
    $html.= '           <th class="head0">Time Stay</th>';
    $html.= '       </tr>';
    $html.= '   </thead>';
    $html.= '   <tbody>';
                foreach($list_stays as $value){
    $html.= '       <tr src="stays">';
    $html.= '           <td>'.$value->user.'</td>';
    $html.= '           <td>'.$value->point.'</td>';
    $html.= '           <td>'.$value->date_in.'</td>';
    $html.= '           <td>'.$value->date_out.'</td>';
    $html.= '           <td>'.gmdate("H:i:s", $value->time_permanence).'</td>';
    $html.= '       </tr>';
                }
    $html.= '   </tbody>';
    $html.= '</table>';

    echo $html;
                
}




