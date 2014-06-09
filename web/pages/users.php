<?php
require_once("../config.php");

$newUser = new user();
$list_users = $newUser->list_users(1);

if ($_POST['action'] == 'Save') {
        if (isset($_POST['hdIdAct'])) {
            $newUser->open($_POST['hdIdAct']);
        }
        if ($_POST['txtName']){
            $newUser->save(1, $_POST['txtName'], $_POST['txtEmail'], $_POST['txtPassword']);
            header("Location: ". $_SERVER['REQUEST_URI']);
            exit;
        }
}
if ($_POST['action'] == 'SaveProfiles') {
        if (isset($_POST['hdIdUP'])) {
        $newUser->saveProfiles($_POST['hdIdUP'],$_POST['prof']);
        header("Location: ". $_SERVER['REQUEST_URI']);
        exit;
    }

}

?>

<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8" />
        <title>User | FOMonitor</title>
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
                <div class="span11">
                    <!-- content -->
                    <div class="content">

                        <!-- start left_menu -->
                        <?php include("../includes/_header_users.php"); ?>
                        <!-- end left_menu -->
                
                        <!-- content-breadcrumb -->
                        <div class="content-breadcrumb">
                            <!--breadcrumb-->
                            <ul class="breadcrumb">
                                <li><a href="index.html"><i class="icofont-home"></i> Users</a> <span class="divider">&rsaquo;</span></li>
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
                                            <span>Users&nbsp;&nbsp;&nbsp;&nbsp;</span>
                                            <a href="#myModal" role="button" class="btn" data-toggle="modal" id="aAdd">Add</a>
                                                    <!-- Modal-->
                                                    <div id="myModal" class="modal hide fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                                                        <div class="modal-header">
                                                            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                                                            <h3 id="myModalLabel">Information</h3>
                                                        </div>
                                                        <div class="modal-body">
                                                            <form class="form-horizontal" id="form-validate" action="" method="post" />
                                                                    <table>
                                                                        <tr>
                                                                            <td>Name</td>
                                                                            <td>
                                                                                <input name="hdIdAct" id="hdIdAct" type="hidden"/>
                                                                                <input type="text" id="txtName" name="txtName" class="grd-white" data-validate="{required: true, messages:{required:'Please enter field required'}}" name="required" id="required" />
                                                                            </td>    
                                                                        </tr>
                                                                        <tr>
                                                                            <td>Email</td>
                                                                            <td>
                                                                                <input type="text" id="txtEmail" name="txtEmail" class="grd-white" data-validate="{required: true, email:true, messages:{required:'Please enter field email', email:'Please enter a valid email address'}}" name="email" id="email" />
                                                                            </td>
                                                                        </tr>
                                                                        <tr>
                                                                            <td>Password</td>
                                                                            <td>
                                                                                <input type="password" id="txtPassword" name="txtPassword" class="grd-white" data-validate="{required: true, messages:{required:'Please enter field password'}}" name="password" id="password" />
                                                                            </td>    
                                                                        </tr>
                                                                        <tr>
                                                                            <td></td>
                                                                            <td><button class="btn" data-dismiss="modal" aria-hidden="true">Close</button>
                                                                            <button class="btn btn-primary" id="btnSave" name="action" value="Save">Save</button></td>
                                                                        </tr>
                                                                    </table>
                                                            </form>
                                                        </div>
                                                    </div>
                                                    <!-- Modal-->
                                                    <div id="myModalProfiles" class="modal hide fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                                                        <div class="modal-header">
                                                            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                                                            <h3 id="myModalLabel">Select Profiles</h3>
                                                        </div>
                                                        <div class="modal-body">
                                                            <form class="form-horizontal" id="form-validate" action="" method="post" />
                                                                <input name="hdIdUP" id="hdIdUP" type="hidden"/>
                                                                <div class="control-group">
                                                                    <div class="controls">
                                                                    </div>
                                                                </div>
                                                                <p align="center">
                                                                <button class="btn" data-dismiss="modal" aria-hidden="true">Close</button>
                                                                <button class="btn btn-primary" id="btnSaveProfiles" name="action" value="SaveProfiles">Save</button>
                                                                </p>

                                                            </form>
                                                        </div>
                                                    </div>

                                        </div>
                                        <div class="box-body">
                                            <table id="datatables" class="table table-bordered table-striped responsive">
                                                <thead>
                                                    <tr>
                                                        <th class="head0">Id</th>
                                                        <th class="head1">Name</th>
                                                        <th class="head0">Email</th>
                                                        <th class="head0">Actions</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    <?php foreach ($list_users as $item) { ?>
                                                        <tr src="user">
                                                            <td><?php echo $item->id; ?><input name="hdId" type="hidden" value="<?php echo $item->id; ?>"/></td>
                                                            <td><?php echo $item->name; ?><input name="hdName" type="hidden" value="<?php echo $item->name; ?>"/></td>
                                                            <td><?php echo $item->email; ?>
                                                                <input name="hdEmail" type="hidden" value="<?php echo $item->email; ?>"/>
                                                            </td>
                                                            <td>
                                                                <a href="#myModal" role="button" class="btn btn-link" data-toggle="modal" id="aEdit">Edit</a>
                                                                <button name="btnDelete" type="button" class="btn btn-link">Delete</button>
                                                                <a href="#myModalProfiles" role="button" class="btn btn-link" data-toggle="modal" id="aProfiles">Profiles</a>
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
               
                //Edit Profile users
                $('a#aProfiles').bind('click',function(){
                    jQuery(this).parents('tr').map(function () {
                        var id = jQuery('input[name="hdId"]', this).val();
                        var action = "getProfiles";

                        $("#hdIdUP").val(id);

                        jQuery.ajax({
                            url: "/ajax/actions.php",
                            type: "POST",
                            data: {id: id, action: action }
                        }).done(function (resp) {
                                $(".controls").html(resp);
                            });
                    });
                    return true;
                });

                //delete individual row
                $('button[name="btnDelete"]').click(function(){
                    var c = confirm('Continue delete?');
                    if (c) jQuery(this).parents('tr').fadeOut(function () {
                        var id = jQuery('input[name="hdId"]', this).val();
                        var src = jQuery(this).attr("src");

                        jQuery.ajax({
                            url: "/ajax/delete.php",
                            type: "POST",
                            data: {id: id, source: src }
                        }).done(function (resp) {
                                jQuery(this).remove();
                            });
                    });
                    return false;
                });


                //update individual row
                $('a#aEdit').bind('click',function(){
                    jQuery(this).parents('tr').map(function () {
                        var id = jQuery('input[name="hdId"]', this).val();
                        var name = jQuery('input[name="hdName"]', this).val();
                        var email = jQuery('input[name="hdEmail"]', this).val();
                        
                        $("#hdIdAct").val(id);
                        $("#txtName").val(name);                       
                        $("#txtEmail").val(email);
                        
                    });
                    return true;
                });

                // validate form
                $("a#aAdd").bind('click', function () {
                    $("#hdIdAct").val('');
                    $("#txtName").val('');
                    $("#txtEmail").val('');
                    $("#txtPassword").val('');
                    
                    var validator = $( "#form-validate" ).validate();
                    validator.resetForm();
                    
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
