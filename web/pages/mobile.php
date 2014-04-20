<?php
require_once("../config.php");

$mobile = new mobile();
$list_mobile = $mobile->getLastData(1);

if ($_POST['action'] == 'Update') {
        if (isset($_POST['hdIdAct'])) {
            $mobile->open($_POST['hdIdAct']);
            $mobile->update($_POST['cboStatus'], $_POST['cboCategory'], 
            				$_POST['txtWarranty'], $_POST['name'],
            				$_POST['txtContact'], $_POST['txtEmail'], $_POST['txtPassword']);
            header("Location: ". $_SERVER['REQUEST_URI']);
            exit;
        }
}
if ($_POST['action'] == 'SaveSettings') {
        if (isset($_POST['hdIdSet'])) {
        	$mobile->open($_POST['hdIdSet']);
        	$mobile->setSettings($_POST);	
        	header("Location: ". $_SERVER['REQUEST_URI']);
        	exit;
    }
}
if ($_POST['action'] == 'SaveApps') {
        if (isset($_POST['hdIdApp'])) {
        	$mobile->open($_POST['hdIdApp']);
        	$mobile->setApps($_POST['app']);	
        	header("Location: ". $_SERVER['REQUEST_URI']);
        	exit;
    }
}
?>

<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8" />
        <title>Tables - Stilearn Admin Bootstrap</title>
        <meta name="viewport" content="width=device-width, initial-scale=1.0" />
        <meta name="description" content="" />
        <meta name="author" content="stilearning" />

        <!-- google font -->
        <link href="http://fonts.googleapis.com/css?family=Aclonica:regular" rel="stylesheet" type="text/css" />

        <!-- styles -->
        <link href="../css/bootstrap.css" rel="stylesheet" />
        <link href="../css/bootstrap-responsive.css" rel="stylesheet" />
        <link href="../css/stilearn.css" rel="stylesheet" />
        <link href="../css/stilearn-responsive.css" rel="stylesheet" />
        <link href="../css/stilearn-helper.css" rel="stylesheet" />
        <link href="../css/stilearn-icon.css" rel="stylesheet" />
        <link href="../css/font-awesome.css" rel="stylesheet" />
        <link href="../css/animate.css" rel="stylesheet" />
        <link href="../css/uniform.default.css" rel="stylesheet" />
        
        <link href="../css/DT_bootstrap.css" rel="stylesheet" />
        <link href="../css/responsive-tables.css" rel="stylesheet" />

        <script src="../js/jquery.js"></script>
        <script src="../js/jquery-ui.min.js"></script> <!-- this for sliders-->        
                
        <!-- Le HTML5 shim, for IE6-8 support of HTML5 elements -->
        <!--[if lt IE 9]>
          <script src="http://html5shim.googlecode.com/svn/trunk/html5.js"></script>
        <![endif]-->
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" /></head>

    <body>
        <!-- start header -->
        <?php include("../includes/_header.php"); ?>
        <!-- end header -->


        <!-- section content -->
        <section class="section">
            <div class="row-fluid">

                <!-- start left_menu -->
                <?php include("../includes/_left_menu.php"); ?>
                <!-- end left_menu -->
                
                <!-- span content -->
                <div class="span9">
                    <!-- content -->
                    <div class="content">
                        <!-- content-header -->
                        <div class="content-header">
                            <ul class="content-header-action pull-right">
                                <li>
                                    <a href="#">
                                        <div class="badge-circle grd-green color-white"><i class="icofont-plus-sign"></i></div>
                                        <div class="action-text color-green">8765 <span class="helper-font-small color-silver-dark">Visits</span></div>
                                    </a>
                                </li>
                                <li class="divider"></li>
                                <li>
                                    <a href="#">
                                        <div class="badge-circle grd-teal color-white"><i class="icofont-user-md"></i></div>
                                        <div class="action-text color-teal">1437 <span class="helper-font-small color-silver-dark">Users</span></div>
                                    </a>
                                </li>
                                <li class="divider"></li>
                                <li>
                                    <a href="#">
                                        <div class="badge-circle grd-orange color-white">$</div>
                                        <div class="action-text color-orange">4367 <span class="helper-font-small color-silver-dark">Orders</span></div>
                                    </a>
                                </li>
                            </ul>
                            <h2><i class="icofont-table"></i> Mobil</h2>
                        </div><!-- /content-header -->
                        
                        <!-- content-breadcrumb -->
                        <div class="content-breadcrumb">
                            <!--breadcrumb-nav-->
                            <ul class="breadcrumb-nav pull-right">
                                <li class="divider"></li>
                                <li class="btn-group">
                                    <a href="#" class="btn btn-small btn-link">
                                        <i class="icofont-money"></i> Orders <span class="color-red">(+12)</span>
                                    </a>
                                </li>
                                <li class="divider"></li>
                                <li class="btn-group">
                                    <a href="#" class="btn btn-small btn-link">
                                        <i class="icofont-user"></i> Users <span class="color-red">(+34)</span>
                                    </a>
                                </li>
                                <li class="divider"></li>
                                <li class="btn-group">
                                    <a href="#" class="btn btn-small btn-link dropdown-toggle" data-toggle="dropdown">
                                        <i class="icofont-tasks"></i> Tasks
                                        <i class="icofont-caret-down"></i>
                                    </a>
                                    <ul class="dropdown-menu">
                                        <li><a href="#">Some Action</a></li>
                                        <li><a href="#">Other Action</a></li>
                                        <li class="divider"></li>
                                        <li><a href="#">Something Else</a></li>
                                    </ul>
                                </li>
                            </ul><!--/breadcrumb-nav-->
                            
                            <!--breadcrumb-->
                            <ul class="breadcrumb">
                                <li><a href="index.html"><i class="icofont-home"></i> Mobil</a> <span class="divider">&rsaquo;</span></li>
                                <li class="active">List</li>
                            </ul><!--/breadcrumb-->
                        </div><!-- /content-breadcrumb -->
                        
                        <!-- content-body -->
                        <div class="content-body">
                            <!-- tables -->
                            <!--datatables-->
                            <div class="row-fluid">
                                <div class="span12">
                                    <div class="box corner-all">
                                        <div class="box-header grd-white corner-top">
                                            <div class="header-control">
                                                <a data-box="collapse"><i class="icofont-caret-up"></i></a>
                                                <a data-box="close" data-hide="bounceOutRight">&times;</a>
                                            </div>
                                            <span>Mobil&nbsp;&nbsp;&nbsp;&nbsp;</span>
                                                <!-- Modal -->
                                                <div id="myModal" class="modal hide fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                                                    <div class="modal-header">
                                                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                                                        <h3 id="myModalLabel">Information</h3>
                                                    </div>
                                                    <div class="modal-body">
                                                        <form class="form-horizontal" id="form-validate" action="" method="post" />
                                                            <input name="hdIdAct" id="hdIdAct" type="hidden"/>
                                                            <p align="center">
                                                            <button class="btn" data-dismiss="modal" aria-hidden="true">Close</button>
                                                            <button class="btn btn-primary" id="btnUpdate" name="action" value="Update">Update</button>
                                                            </p>

                                                        </form>
                                                    </div>
                                                </div>
                                                <!-- Modal Details-->
                                                <div id="myModalDetalis" class="modal hide fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                                                    <div class="modal-header">
                                                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                                                        <h3 id="myModalLabel">Details</h3>
                                                    </div>
                                                    <div class="modal-body">
                                                        <form class="form-horizontal" id="form-validate" action="" method="post" />
                                                            <input name="hdIdDet" id="hdIdDet" type="hidden"/>
                                                        </form>
                                                    </div>
                                                </div>

                                                <!-- Modal Settings-->
                                                <div id="myModalSettings" class="modal hide fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                                                    <div class="modal-header">
                                                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                                                        <h3 id="myModalLabel">Update Settings Allowed</h3>
                                                    </div>
                                                    <div class="modal-body">
                                                        <form class="form-horizontal" id="form-validate" action="" method="post" />
                                                            <input name="hdIdSet" id="hdIdSet" type="hidden"/>

                                                            <p align="center">
                                                            <button class="btn" data-dismiss="modal" aria-hidden="true">Close</button>
                                                            <button class="btn btn-primary" id="btnSaveSettings" name="action" value="SaveSettings">Update</button>
                                                            </p>

                                                        </form>
                                                    </div>
                                                </div>
                                                <!-- Modal Apps-->
                                                <div id="myModalApps" class="modal hide fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                                                    <div class="modal-header">
                                                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                                                        <h3 id="myModalLabel">Update Applications Allowed</h3>
                                                    </div>
                                                    <div class="modal-body">
                                                        <form class="form-horizontal" id="form-validate" action="" method="post" />
                                                            <input name="hdIdApp" id="hdIdApp" type="hidden"/>
                                                            <p align="center">
                                                            <button class="btn" data-dismiss="modal" aria-hidden="true">Close</button>
                                                            <button class="btn btn-primary" id="btnSaveApps" name="action" value="SaveApps">Save</button>
                                                            </p>

                                                        </form>
                                                    </div>
                                                </div>
                                                <!-- Modal Map-->
                                                <div id="myModalMap" class="modal hide fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                                                    <div class="modal-header">
                                                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                                                        <h3 id="myModalLabel">User on the Map</h3>
                                                    </div>
                                                    <div class="modal-body">
                                                        <form class="form-horizontal" id="form-validate" action="" method="post" />
                                                            <input name="hdIdMap" id="hdIdMap" type="hidden"/>
                                                        </form>
                                                    </div>
                                                </div>

                                        </div>
                                        <div class="box-body">
                                            <table id="datatables" class="table table-bordered table-striped responsive">
                                                <thead>
                                                    <tr>
                                                        <th class="head0">User</th>
                                                        <th class="head1">Battery</th>
                                                        <th class="head0">Signal</th>
                                                        <th class="head0">Accuracy</th>
                                                        <th class="head0">Speed</th>
                                                        <th class="head0">Last Update</th>
                                                        <th class="head0">Status</th>
                                                        <th class="head0">Actions</th>
                                                        <th class="head0"></th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    <?php foreach ($list_mobile as $item) { ?>
                                                        <tr src="user">
                                                            <td>
                                                            <input name="hdId" type="hidden" value="<?php echo $item->imeiMobil; ?>"/>
                                                            <?php echo $item->name; ?>
                                                            </td>
                                                            <td><?php echo number_format(($item->batterylevel * 100), 1, ",", ""); ?> %</td>
                                                            <td><?php echo $item->gsm_strength_param; ?></td>
                                                            <td><?php echo number_format($item->accuracy, 2, ",", ""); ?> m</td>
                                                            <td><?php echo number_format($item->speed * 3.6, 1, ",", ""); ?> km/h</td>
                                                            <td><?php echo format_date($item->date); ?></td>
                                                            <td>Status</td>
                                                            <td><a href="#myModal" role="button" class="btn btn-link" data-toggle="modal" id="aEdit">Edit</a>
                                                            	<a href="#myModalDetalis" role="button" class="btn btn-link" data-toggle="modal" id="aDetails">Details</a>
                                                            </td>
                                                            <td>
                                                                <a href="#myModalMap" role="button" class="btn btn-link" data-toggle="modal" id="aMap"><i class="icon-map-marker" title="View On Map"></i></a>
                                                                <a href="#myModalSettings" role="button" class="btn btn-link" data-toggle="modal" id="aSettings"><i class="icon-wrench" title="Update Allowed Settings"></i></a>
                                                                <a href="#myModalApps" role="button" class="btn btn-link" data-toggle="modal" id="aApps"><i class="icon-th-large" title="Update Allowed Applications"></i></a>
                                                            </td>
                                                        </tr>
                                                    <?php } ?>
                                                </tbody>
                                            </table>
                                        </div><!-- /box-body -->
                                    </div><!-- /box -->
                                </div><!-- /span -->
                            </div><!--/datatables-->
                            <!--/tables-->
                        </div><!--/content-body -->
                    </div><!-- /content -->
                </div><!-- /span content -->
                
                <!-- start right_menu -->
                <?php include("../includes/_right_menu.php"); ?>
                <!-- end right_menu -->

            </div>
        </section>

        <!-- start left_menu -->
        <?php include("../includes/_footer.php"); ?>
        <!-- end left_menu -->


        <!-- javascript
        ================================================== -->
        <script type="text/javascript" src="http://platform.twitter.com/widgets.js"></script>
        <script src="../js/bootstrap.js"></script>
        <script src="../js/uniform/jquery.uniform.js"></script>

        <script src="../js/validate/jquery.validate.js"></script>
        <script src="../js/validate/jquery.metadata.js"></script>
        
        <script src="../js/datatables/jquery.dataTables.min.js"></script>
        <script src="../js/datatables/extras/ZeroClipboard.js"></script>
        <script src="../js/datatables/extras/TableTools.min.js"></script>
        <script src="../js/datatables/DT_bootstrap.js"></script>
        <script src="../js/responsive-tables/responsive-tables.js"></script>
        
        <!-- required stilearn template js, for full feature-->
        <script src="../js/holder.js"></script>
        <script src="../js/stilearn-base.js"></script>

        <script type="text/javascript">
            $(document).ready(function() {
                // try your js
                /*
                jQuery(".sidebar-right-content *").prop('disabled',true); 
                jQuery(".sidebar-right-content").css({ opacity: 0.5 });
                */    
                jQuery("label.checkbox").each(function () {
                if (jQuery("input", this).attr("checked") == 'checked') jQuery(this).addClass("checked");
                });

                $('#myModal').on('shown', function () {
                    $('#txtName').focus();
                });
               
                //Update Settings
                $('a#aSettings').bind('click',function(){
                    jQuery(this).parents('tr').map(function () {
                        var id = jQuery('input[name="hdId"]', this).val();
                        var action = "getSettings";

                        $("#hdIdSet").val(id);

                        jQuery.ajax({
                            url: "/ajax/actions.php",
                            type: "POST",
                            data: {id: id, action: action }
                        }).done(function (resp) {
                                //$(".controls").html(resp);
                            });
                    });
                    return true;
                });

                //Update Apps
                $('a#aApps').bind('click',function(){
                    jQuery(this).parents('tr').map(function () {
                        var id = jQuery('input[name="hdId"]', this).val();
                        var action = "getApps";

                        $("#hdIdApp").val(id);

                        jQuery.ajax({
                            url: "/ajax/actions.php",
                            type: "POST",
                            data: {id: id, action: action }
                        }).done(function (resp) {
                                //$(".controls").html(resp);
                            });
                    });
                    return true;
                });

                //User Map
                $('a#aMap').bind('click',function(){
                    jQuery(this).parents('tr').map(function () {
                        var id = jQuery('input[name="hdId"]', this).val();
                        var action = "getUserMap";

                        $("#hdIdMap").val(id);

                        jQuery.ajax({
                            url: "/ajax/actions.php",
                            type: "POST",
                            data: {id: id, action: action }
                        }).done(function (resp) {
                                //$(".controls").html(resp);
                            });
                    });
                    return true;
                });

                //update individual row
                $('a#aEdit').bind('click',function(){
                    jQuery(this).parents('tr').map(function () {
                        var id = jQuery('input[name="hdId"]', this).val();
                        var action = "getDetailstoUpdate";

                        $("#hdIdAct").val(id);

                        jQuery.ajax({
                            url: "/ajax/actions.php",
                            type: "POST",
                            data: {id: id, action: action }
                        }).done(function (resp) {
                                //$(".controls").html(resp);
                            });
                    });
                    return true;
                });

                //view mobile details
                $('a#aDetails').bind('click',function(){
                    jQuery(this).parents('tr').map(function () {
                        var id = jQuery('input[name="hdId"]', this).val();
                        var action = "getDetails";

                        $("#hdIdAct").val(id);

                        jQuery.ajax({
                            url: "/ajax/actions.php",
                            type: "POST",
                            data: {id: id, action: action }
                        }).done(function (resp) {
                                //$(".controls").html(resp);
                            });
                    });
                    return true;
                });

                $('#form-validate').validate();
                
                // uniform
                $('[data-form=uniform]').uniform();
                
                // datatables
                $('#datatables').dataTable( {
                    "sDom": "<'row-fluid'<'span6'l><'span6'f>r>t<'row-fluid'<'span6'i><'span6'p>>",
                    "sPaginationType": "bootstrap",
                    "oLanguage": {
                            "sLengthMenu": "_MENU_ records per page"
                    }
                });
                
                // datatables table tools
                $('#datatablestools').dataTable({
                    "sDom": "<'row-fluid'<'span6'T><'span6'f>r>t<'row-fluid'<'span6'i><'span6'p>>",
                    "oTableTools": {
                        "aButtons": [
                            "copy",
                            "print",
                            {
                                "sExtends":    "collection",
                                "sButtonText": 'Save <span class="caret" />',
                                "aButtons":    [ 
                                    "xls", 
                                    "csv",
                                    {
                                        "sExtends": "pdf",
                                        "sPdfOrientation": "landscape",
                                        "sPdfMessage": "Your custom message would go here."
                                    }
                                ]
                            }
                        ],
                        "sSwfPath": "../js/datatables/swf/copy_csv_xls_pdf.swf"
                    }
                });
            });
      
        </script>
    </body>
</html>
