<?php
require_once("../config.php");

$catAdd = false;
$catUpd = false;
$catDel = false;

$category = new category();

if ($_POST['action'] == 'Save') {
    if (isset($_POST['hdIdAct'])) {
        if ($_POST['hdIdAct'] == ""){
            $category->save($company->id, $_POST['txtDescription']);
            $catAdd = true;
        }else{
            $category->open($_POST['hdIdAct']);
            $category->save($company->id, $_POST['txtDescription']);
            $catUpd = true;
        }
    }
}

if ($_POST['action'] == 'Delete') {
    if (isset($_POST['hdIdDE'])) {
        $category->open($_POST['hdIdDE']);
        $category->del();
        $catDel = true;
    }
}

$list_categories = $category->list_categories($company->id);
?>

<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8" />
        <link rel="shortcut icon" href="../img/icon.png">
        <title>Categories | FOMonitor</title>
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
        
        <link href="../css/jquery.pnotify.default.css" rel="stylesheet" />
        <link href="../css/DT_bootstrap.css" rel="stylesheet" />
        <link href="../css/responsive-tables.css" rel="stylesheet" />
        
        <script src="../js/jquery.js"></script>
        <script src="../js/jquery-ui.min.js"></script> <!-- this for sliders-->     
        
        <!-- Le HTML5 shim, for IE6-8 support of HTML5 elements -->
        <!--[if lt IE 9]>
          <script src="http://html5shim.googlecode.com/svn/trunk/html5.js"></script>
        <![endif]-->
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" /></head>
<?php
if($catAdd){
    echo '<style type="text/css">
        div[name=catAdded] {
            display: block !important;
        }
        </style>';
}else{
    echo '<style type="text/css">
        div[name=catAdded] {
            display: none !important;
        }
        </style>';
}

if($catUpd){
    echo '<style type="text/css">
        div[name=catUpdated] {
            display: block !important;
        }
        </style>';
}else{
    echo '<style type="text/css">
        div[name=catUpdated] {
            display: none !important;
        }
        </style>';
}

if($catDel){
    echo '<style type="text/css">
        div[name=catDeleted] {
            display: block !important;
        }
        </style>';
}else{
    echo '<style type="text/css">
        div[name=catDeleted] {
            display: none !important;
        }
        </style>';
}

?>
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
                                <li><a href="index.html"><i class="icofont-home"></i> Categories</a> <span class="divider">&rsaquo;</span></li>
                                <li class="active">List</li>
                            </ul><!--/breadcrumb-->
                        </div><!-- /content-breadcrumb -->
                        
                        <!-- content-body -->
                        <div class="content-body">
                            <!-- tables -->
                            <!--datatables-->
                            <div name="catAdded" class="alert alert-success">
                                <button type="button" class="close" data-dismiss="alert">×</button>
                                <strong>Done!</strong> Your category was created
                            </div>
                            <div name="catUpdated" class="alert alert-success">
                                <button type="button" class="close" data-dismiss="alert">×</button>
                                <strong>Done!</strong> Your category was updated
                            </div>
                            <div name="catDeleted" class="alert alert-success">
                                <button type="button" class="close" data-dismiss="alert">×</button>
                                <strong>Done!</strong> Your category was deleted
                            </div>
                            <div class="row-fluid">
                                <div class="span12">
                                    <div class="box corner-all">
                                        <div class="box-header grd-white corner-top">
                                            <div class="header-control">
                                                <a data-box="collapse"><i class="icofont-caret-up"></i></a>
                                                <a data-box="close" data-hide="bounceOutRight">&times;</a>
                                            </div>
                                            <span>Categories&nbsp;&nbsp;&nbsp;&nbsp;</span>
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
                                                                        <td>Description</td>
                                                                        <td>
                                                                            <input name="hdIdAct" id="hdIdAct" type="hidden"/>
                                                                            <input type="text" id="txtDescription" name="txtDescription" class="grd-white" data-validate="{required: true, messages:{required:'Please enter field required'}}" name="required" id="required" />
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
                                                <!-- Modal Delete-->
                                                <div id="myModalDelete" class="modal hide fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                                                    <div class="modal-header">
                                                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                                                        <h3 id="myModalLabel">Delete Category</h3>
                                                    </div>
                                                    <div class="modal-body">
                                                        <form class="form-horizontal" id="form-validate" action="" method="post" />
                                                            <input name="hdIdDE" id="hdIdDE" type="hidden"/>
                                                            <div class="control-group">
                                                                <label class="control-label">Are you sure?</label>
                                                            </div>
                                                            <p align="center">
                                                            <button class="btn" data-dismiss="modal" aria-hidden="true">Close</button>
                                                            <button class="btn btn-primary" id="btnDelete" name="action" value="Delete">Delete</button>
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
                                                        <th class="head1">Description</th>
                                                        <th class="head1">Code</th>
                                                        <th class="head0">Actions</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    <?php foreach ($list_categories as $item) { ?>
                                                        <tr src="category">
                                                            <td><?php echo $item->id; ?><input name="hdId" type="hidden" value="<?php echo $item->id; ?>"/></td>
                                                            <td><?php echo $item->description; ?><input name="hdDesc" type="hidden" value="<?php echo $item->description; ?>"/></td>
                                                            <td><?php echo $item->code; ?></td>
                                                            <td>
                                                                <a href="#myModal" role="button" class="btn btn-link" data-toggle="modal" id="aEdit">Edit</a>
                                                                <a href="#myModalDelete" role="button" class="btn btn-link" data-toggle="modal" id="aDelete">Delete</a>
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

        <script src="../js/pnotify/jquery.pnotify.js"></script>
        <script src="../js/pnotify/jquery.pnotify.demo.js"></script>

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

                window.setTimeout(function() {
                    $("div[name=catAdded]").fadeTo(200, 0).slideUp(200, function(){
                        $(this).remove(); 
                    });
                    $("div[name=catUpdated]").fadeTo(200, 0).slideUp(200, function(){
                        $(this).remove(); 
                    });
                    $("div[name=catDeleted]").fadeTo(200, 0).slideUp(200, function(){
                        $(this).remove(); 
                    });
                }, 2000);

                $('#myModal').on('shown', function () {
                    $('#txtDescription').focus();
                });

                //update individual row
                $('a#aEdit').bind('click',function(){
                    jQuery(this).parents('tr').map(function () {
                        var id = jQuery('input[name="hdId"]', this).val();
                        var desc = jQuery('input[name="hdDesc"]', this).val();
                        $("#hdIdAct").val(id);
                        $("#txtDescription").val(desc);                       
                    });
                    var validator = $( "#form-validate" ).validate();
                    validator.resetForm();

                    return true;
                });

                //delete individual row
                $('a#aDelete').bind('click',function(){
                    jQuery(this).parents('tr').map(function () {
                       var id = jQuery('input[name="hdId"]', this).val();
                        $("#hdIdDE").val(id);
                    });
                    return true;
                });

                // validate form
                $("a#aAdd").bind('click', function () {
                    $("#hdIdAct").val('');
                    $("#txtDescription").val('');

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
