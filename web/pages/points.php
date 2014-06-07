<?php
require_once("../config.php");

$point = new point();
$list_points = $point->list_points($company->id);

if ($_POST['action'] == 'Save') {

    if (isset($_POST['hdIdAct'])) {
        $point->open($_POST['hdIdAct']);
    }
     if ($_POST['txtName']){
        $point->save($company->id, $_POST['txtName'], $_POST['txtAddr_street'], $_POST['txtAddr_number'], $_POST['txtAddr_district'], $_POST['txtAddr_city'], $_POST['txtAddr_state'], $_POST['txtAddr_postalcode'], $_POST['latitude'], $_POST['longitude'], $_POST['txtRadius']);
        $list_points = $point->list_points($company->id);
    }
}

?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN"
    "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml"> 
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
                                <li><a href="index.html"><i class="icofont-home"></i> Points</a> <span class="divider">&rsaquo;</span></li>
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
                                            <span>Points&nbsp;&nbsp;&nbsp;&nbsp;</span>
                                            <a href="#myModal" role="button" class="btn" data-toggle="modal" id="aAdd">Add</a>
                                                
                                                    <!-- Modal -->
                                                    <div id="myModal" class="modal hide fade" style="width:900px !important;height:550px;" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                                                        <div class="modal-header">
                                                            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                                                            <h3 id="myModalLabel">Information</h3>
                                                        </div>
                                                        <div style="position: relative;overflow-y: auto;padding: 15px;" class="content-modal">
                                                            <form class="form-horizontal" id="form-validate" action="" method="post" />
                                                                <table>
                                                                    <tr>
                                                                        <td>Name</td>
                                                                        <td><input type="text" id="txtName" name="txtName" class="grd-white" data-validate="{required: true, messages:{required:'Please enter field required'}}" name="required" id="required" value="<?php echo $point->name ?>" /></td>
                                                                        <td rowspan="8" style="width:55% !important;"><div class="mapa" id="mapa"  style="height:400px; width: 100%; float: right"></div></td>
                                                                    </tr>
                                                                    <tr>
                                                                        <td>Street</td>
                                                                        <td><input type="text" id="txtAddr_street" value="<?php echo $point->addr_street ?>" name="txtAddr_street" class="grd-white" data-validate="{required: true, messages:{required:'Please enter field required'}}" name="required" id="required" /></td>
                                                                    </tr>
                                                                    <tr>
                                                                        <td>Número</td>
                                                                        <td><input type="text" id="txtAddr_number" value="<?php echo $point->addr_number ?>" name="txtAddr_number" class="grd-white" data-validate="{required: true, messages:{required:'Please enter field required'}}" name="required" id="required" /></td>
                                                                    </tr>
                                                                    <tr>
                                                                        <td>District</td>
                                                                        <td><input type="text" id="txtAddr_district" value="<?php echo $point->addr_district ?>" name="txtAddr_district" class="grd-white" data-validate="{required: true, messages:{required:'Please enter field required'}}" name="required" id="required" /></td>
                                                                    </tr>
                                                                    <tr>
                                                                        <td>City</td>
                                                                        <td><input type="text" id="txtAddr_city" value="<?php echo $point->addr_city ?>" name="txtAddr_city" class="grd-white" data-validate="{required: true, messages:{required:'Please enter field required'}}" name="required" id="required" /></td>
                                                                    </tr>
                                                                    <tr>
                                                                        <td>State</td>
                                                                        <td><input type="text" id="txtAddr_state" value="<?php echo $point->addr_state ?>" name="txtAddr_state" class="grd-white" data-validate="{required: true, messages:{required:'Please enter field required'}}" name="required" id="required" /></td>
                                                                    </tr>
                                                                    <tr>
                                                                        <td>Postal code</td>
                                                                        <td><input type="text" id="txtAddr_postalcode" value="<?php echo $point->addr_postalcode ?>" name="txtAddr_postalcode" class="grd-white" data-validate="{required: true, messages:{required:'Please enter field required'}}" name="required" id="required" />
                                                                            <input type="hidden" id="latitude" name="latitude" value="<?php echo $poi->latitude ?>" />
                                                                            <input type="hidden" id="longitude" name="longitude" value="<?php echo $poi->longitude ?>" />
                                                                        </td>
                                                                    </tr>
                                                                    <tr>
                                                                        <td>Radius (meters)</td>
                                                                        <td><input type="text" id="txtRadius" value="<?php echo $point->addr_radius ?>" name="txtRadius" class="grd-white" data-validate="{required: true, messages:{required:'Please enter field required'}}" name="required" id="required" /></td>
                                                                    </tr>
                                                                    <tr>
                                                                        <td></td>
                                                                        <td><button class="btn" data-dismiss="modal" aria-hidden="true">Close</button>
                                                                            <button class="btn btn-primary" id="btnSave" name="action" value="Save">Save</button>
                                                                        </td>
                                                                    </tr>
                                                                </table>
                                                                <input name="hdIdAct" id="hdIdAct" type="hidden"/>
                                                            </form>
                                                        </div>
                                                    </div>
                                        </div>
                                        <div class="box-body">
                                            <table id="datatables" class="table table-bordered table-striped responsive">
                                                <thead>
                                                    <tr>
                                                        <th class="head0">Id</th>
                                                        <th class="head0">Nome</th>
                                                        <th class="head1">Street</th>
                                                        <th class="head0">Number</th>
                                                        <th class="head1">District</th>
                                                        <th class="head0">City</th>
                                                        <th class="head1">State</th>
                                                        <th class="head0">PostalCode</th>
                                                        <th class="head1">Actions</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    <?php foreach ($list_points as $item) { ?>
                                                        <tr src="point">
                                                            <td><?php echo $item->id; ?><input name="hddId" type="hidden" value="<?php echo $item->id; ?>"/></td>
                                                            <td><?php echo $item->name; ?></td><input name="hddName" type="hidden" value="<?php echo $item->name; ?>"/></td>
                                                            <td><?php echo $item->addr_street; ?></td><input name="hddAddr_street" type="hidden" value="<?php echo $item->addr_street; ?>"/></td>
                                                            <td><?php echo $item->addr_number; ?></td><input name="hddAddr_number" type="hidden" value="<?php echo $item->addr_number; ?>"/></td>
                                                            <td><?php echo $item->addr_district; ?></td><input name="hddAddr_district" type="hidden" value="<?php echo $item->addr_district; ?>"/></td>
                                                            <td><?php echo $item->addr_city; ?></td><input name="hddAddr_city" type="hidden" value="<?php echo $item->addr_city; ?>"/></td>
                                                            <td><?php echo $item->addr_state; ?></td><input name="hddAddr_state" type="hidden" value="<?php echo $item->addr_state; ?>"/></td>
                                                            <td><?php echo $item->addr_postalcode; ?></td><input name="hddAddr_postalcode" type="hidden" value="<?php echo $item->addr_postalcode; ?>"/>
                                                                <input name="hddLatitude" type="hidden" value="<?php echo $item->latitude; ?>"/>
                                                                <input name="hddLongitude" type="hidden" value="<?php echo $item->longitude; ?>"/>
                                                                <input name="hddRadius" type="hidden" value="<?php echo $item->radius; ?>"/>
                                                            </td>
                                                            <td>
                                                                <a href="#myModal" role="button" class="btn btn-link" data-toggle="modal" id="aEdit" >Edit</a>
                                                                <button name="btnDelete" type="button" class="btn btn-link">Delete</button>
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

        <script src="https://maps.googleapis.com/maps/api/js?v=3.exp&sensor=false"></script>

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
                //delete individual row
                $('button[name="btnDelete"]').click(function(){
                    var c = confirm('Continue delete?');
                    if (c) jQuery(this).parents('tr').fadeOut(function () {
                        var id = jQuery("input", this).val();
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
                        $("#hdIdAct").val(jQuery('input[name="hddId"]', this).val());
                        $("#txtName").val(jQuery('input[name="hddName"]', this).val());
                        $("#txtAddr_street").val(jQuery('input[name="hddAddr_street"]', this).val());
                        $("#txtAddr_number").val(jQuery('input[name="hddAddr_number"]', this).val());
                        $("#txtAddr_district").val(jQuery('input[name="hddAddr_district"]', this).val());
                        $("#txtAddr_city").val(jQuery('input[name="hddAddr_city"]', this).val());
                        $("#txtAddr_state").val(jQuery('input[name="hddAddr_state"]', this).val());
                        $("#txtAddr_postalcode").val(jQuery('input[name="hddAddr_postalcode"]', this).val());
                        $("#latitude").val(jQuery('input[name="hddLatitude"]', this).val());
                        $("#longitude").val(jQuery('input[name="hddLongitude"]', this).val());
                        $("#txtRadius").val(jQuery('input[name="hddRadius"]', this).val());
                    });
                    return true;
                });

                // validate form
                $("a#aAdd").bind('click', function () {
                    var validator = $( "#form-validate" ).validate();
                    validator.resetForm();
                });

                $('#myModal').on('shown', function () {
                    google.maps.event.trigger(map, "resize");
                    plotLocation();
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
      

//INIT MAP

    var map;
    var markersArray = [];
    var circlesArray = [];
    var infoWindow = new google.maps.InfoWindow({maxWidth: 200});

    jQuery(document).ready(function(){
        initMap();
        resizeMap();

        jQuery('#txtAddr_street, #txtAddr_number, #txtAddr_district, #txtAddr_city, #txtAddr_state, #txtAddr_postalcode, #txtRadius').focusout(plotLocation);
        if(jQuery('#latitude').val() != '' && jQuery('#longitude').val() != ''){
            plotLocation();
        }
        

    });
    function resizeMap(){
        var sizeForm = jQuery('.form.left').width();
        var sizeContent = jQuery('.content-modal').width();
        

        var sizeMap = sizeContent-(sizeForm);
        jQuery(".form.left").css('padding-right', '30px');
        jQuery("#mapa").attr("width", sizeMap);
    }

    jQuery(window).resize(function(){
        resizeMap();
    });


    function initMap() {
        var options = {
            zoom: 15,
            center: new google.maps.LatLng('-23.565262', '-46.683653'),
            mapTypeId: google.maps.MapTypeId.ROADMAP
        };

        map = new google.maps.Map(document.getElementById("mapa"), options);

        google.maps.event.addListener(map, 'click', function() {
            if (infoWindow) {
                infoWindow.close();
            }
        });
    }

    function plotLocation() {
        deleteOverlays();

        var address = addVirgula(jQuery('#txtAddr_street').val()) +
            addVirgula(jQuery('#txtAddr_number').val()) +
            addVirgula(jQuery('#txtAddr_district').val()) +
            addVirgula(jQuery('#txtAddr_city').val()) +
            addVirgula(jQuery('#txtAddr_state').val()) +
            addVirgula(jQuery('#txtAddr_postalcode').val());
        address = address.substr(0, address.length - 1);
        var geocoder = new google.maps.Geocoder();
        if(address) {
            geocoder.geocode({'address': address}, function(results, status) {
                if (status == google.maps.GeocoderStatus.OK) {
                    var marker = new google.maps.Marker({
                        title: address,
                        /* icon: WEBROOT + 'img/permissoes-unidades.png',*/
                        position: results[0].geometry.location
                    });
                    markersArray.push(marker);

                    marker.setMap(map);
                    map.setCenter(results[0].geometry.location);

                    infoWindow.setContent(results[0].formatted_address);
                    infoWindow.open(map, marker);

                    google.maps.event.addListener(marker, 'click', function() {
                        infoWindow.setContent(results[0].formatted_address);
                        infoWindow.open(map, marker);
                    });
                    if ((jQuery.type(results[0].address_components[6]) !== 'undefined') && (jQuery("#txtAddr_postalcode").val() == '')) {
                        jQuery("#txtAddr_postalcode").val(results[0].address_components[6].short_name);
                    }

                    jQuery('#latitude').val(results[0].geometry.location.lat());
                    jQuery('#longitude').val(results[0].geometry.location.lng());

                    // Add circle over map
                    var rad = parseFloat(jQuery('#txtRadius').val());

                    if (rad!="" && rad != NaN)
                    {
                        var circle = new google.maps.Circle({
                            center: results[0].geometry.location,
                            radius: 1*rad,
                            strokeColor: "#0000FF",
                            strokeOpacity: 0.8,
                            strokeWeight: 2,
                            fillColor: "#0000FF",
                            fillOpacity: 0.4
                        });     

                        circle.setMap(map);

                        circlesArray.push(circle);
                    }
                }
            });
        }
    }

    function deleteOverlays() {
        if (markersArray) {
            for (i in markersArray) {
                markersArray[i].setMap(null);
            }
            markersArray.length = 0;
        }

        if (circlesArray) {
            for (i in circlesArray) {
                circlesArray[i].setMap(null);
            }
            circlesArray.length = 0;
        }

        
    }

    function addVirgula(campo) {

        return (campo) ? campo+',' : '';

    }

//END MAP

        </script>
    </body>
</html>
