<?php
require_once("../config.php");

$category = new category();
$list_categories = $category->list_categories($company->id);

$point = new point();
$list_points = $point->list_points($company->id);
$jlist_points = json_encode($list_points);

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

        <link href="../css/select2.css" rel="stylesheet" />
        
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
                            <h2><i class="icofont-table"></i> Map</h2>
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
                                <li><a href="index.html"><i class="icofont-home"></i> Map</a> <span class="divider">&rsaquo;</span></li>
                                <li class="active">Map</li>
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
                                            <span>Map</span>
                                            
                                        </div>
                                        <div class="box-body">
                                           <div class="control-group">
                                                <div class="controls form-inline" style="text-align:center;">
                                                    <label class="control-label" for="isCategories">Categories</label>
                                                    &nbsp;
                                                    <select id="isCategories" data-form="select2" style="width:200px;" data-placeholder="Select category...">
                                                        <option value="-1"/>Select category...
                                                        <?php foreach ($list_categories as $item) { ?>
                                                        <option value="<?php echo $item->id; ?>"/><?php echo $item->description; ?>
                                                        <?php }?>
                                                    </select>
                                                    &nbsp;&nbsp;
                                                    <label class="checkbox inline" id="lblAllPoints" name="lblAllPoints">
                                                        <input type="checkbox" data-form="uniform" name="chkAllPoints" id="chkAllPoints" value="option2" /> All Points
                                                    </label>
                                                    &nbsp;
                                                    <select id="ismPoints" data-form="select2" style="width:200px" data-placeholder="Select points..." multiple="">
                                                        <?php foreach ($list_points as $item) { ?>
                                                        <option value="<?php echo $item->id; ?>"/><?php echo $item->name; ?>
                                                        <?php }?>
                                                    </select>
                                                    &nbsp;
                                                    <button type="button" id="btnClearPoints" name="btnClearPoints" class="btn">Clear</button>
                                                    &nbsp;&nbsp;
                                                    <button type="button" class="btn btn-primary" id="bntShow">Show</button>
                                                </div>
                                            </div>
                                            <div class="divider-content" id="dvDivConUsers" style="display:none;"><span></span></div>
                                            <div class="control-group">
                                                <div class="controls form-inline" id="dvFilterUsers" style="text-align:center;display:none;">
                                                    <label class="checkbox inline" id="lblAllUsers" name="lblAllUsers">
                                                        <input type="checkbox" data-form="uniform" name="chkAllUsers" id="chkAllUsers" value="option1"/> All Users
                                                    </label>
                                                    &nbsp;
                                                    <input type="hidden" id="ismUsers" style="width:200px"/>
                                                    &nbsp;
                                                    <button type="button" class="btn" id="btnClearUsers" name="btnClearUsers">Clear</button>
                                                </div>
                                            </div>
                                            <div class="divider-content"><span></span></div>
                                            <div class="mapa" id="mapa" style="height:450px; width: 100%;"></div>
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

        <script src="https://maps.googleapis.com/maps/api/js?v=3.exp&sensor=false"></script>

        <script src="../js/select2/select2.js"></script>

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

                var myLatlng;
                var mapOptions;
                var map;

                myLatlng = new google.maps.LatLng('-23.565262', '-46.683653');
                        mapOptions = {
                            zoom: 8,
                            center: myLatlng
                        };

                map = new google.maps.Map(document.getElementById('mapa'), mapOptions);

                // try your js

                $('#form-validate').validate();
                
                // uniform
                $('[data-form=uniform]').uniform();

                // select2
                $('[data-form=select2]').select2();
                
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

                //Get users by categories
                var data;
                function format(item) { return item.name; }
                $('#isCategories').on('change', function(){
                    var id = $(this).val();
                    var action = "getUsersByCategory";
                    jQuery.ajax({
                        url: "/ajax/actions.php",
                        type: "POST",
                        data: {id: id, action: action }
                    }).done(function (resp) {
                        data = jQuery.parseJSON(resp);
                        $("#chkAllUsers").removeAttr( "checked" );
                        $("#chkAllUsers").removeClass( "checked" );
                        $("#chkAllUsers").parent().removeAttr( "checked" );
                        $("#chkAllUsers").parent().removeClass( "checked" );
                        $("#ismUsers").val('').trigger("change");
                        $("#ismUsers").select2({
                            data:{ results: data, text: 'name' },
                            multiple: true,
                            formatSelection: format,
                            placeholder: "Select users...",
                            formatResult: format,
                            initSelection : function (element, callback) {
                                callback(data);
                            }
                        });    
                        $( "#dvDivConUsers" ).show();
                        $( "#dvFilterUsers" ).show();
                    });

                });
                $("#chkAllUsers").click(function () {
                    if (jQuery(this).attr("checked") == 'checked') {
                        $("#ismUsers").val('data').trigger("change");
                    } else {
                        $("#ismUsers").val('').trigger("change");
                    }
                });

                $("#btnClearUsers").click(function () {
                    $("#ismUsers").val('').trigger("change");
                    if (jQuery("#chkAllUsers").attr("checked") == 'checked'){
                        $("#chkAllUsers").removeAttr( "checked" );
                        $("#chkAllUsers").removeClass( "checked" );
                        $("#chkAllUsers").parent().removeAttr( "checked" );
                        $("#chkAllUsers").parent().removeClass( "checked" );
                    }
                });

                $("#chkAllPoints").click(function(){
                    if($("#chkAllPoints").is(':checked') ){
                        $("#ismPoints > option").prop("selected","selected");
                        $("#ismPoints").trigger("change");
                    }else{
                        $("#ismPoints > option").removeAttr("selected");
                        $("#ismPoints").trigger("change");
                    }
                });

                $("#btnClearPoints").click(function () {
                    $("#ismPoints").val('').trigger("change");
                    if (jQuery("#chkAllPoints").attr("checked") == 'checked'){
                        $("#chkAllPoints").removeAttr( "checked" );
                        $("#chkAllPoints").removeClass( "checked" );
                        $("#chkAllPoints").parent().removeAttr( "checked" );
                        $("#chkAllPoints").parent().removeClass( "checked" );
                    }
                });



                $("#bntShow").click(function(){
                    alert('users'+ $("#ismUsers").val() + 'points'+ $("#ismPoints").val());
                });

                $('#ismUsers').on("change", function(e) {
                    alert('users'+ $("#ismUsers").val() + 'points'+ $("#ismPoints").val());
                });

                $('#ismPoints').on("change", function(e) {
                    alert('users'+ $("#ismUsers").val() + 'points'+ $("#ismPoints").val());
                });
            });
        </script>
    </body>
</html>
