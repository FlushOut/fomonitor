<?php

$company->open($company->id);

if ($_POST['action'] == 'SaveCompany') {
    echo "SaveCompany";
     if (isset($_POST['txtCompanyName'])){
        echo "txtCompanyName";
        $company->save($_POST['txtCompanyName'], $_FILES["txtCompanyLogo"]["tmp_name"],$_FILES["txtCompanyLogo"]["type"],$_POST['txtCompanyGps_time'], $_POST['txtCompanyGps_distance'], $_POST['txtCompanyInactive_time'], $_POST['txtCompanyIdle_time']);
        $company->open($company->id);
    }
}

?>

<script type="text/javascript">
    function soloNumeros(e){
        var key = window.Event ? e.which : e.keyCode
        return (key >= 48 && key <= 57)
    }
</script>

<header class="header" data-spy="affix" data-offset-top="0">
            <!--nav bar helper-->
            <div class="navbar-helper">
                <div class="row-fluid">
                    <!--panel site-name-->
                    <div class="span2">
                        <div class="panel-sitename">
                            <h2><a href="index.html"><span class="color-teal">fo</span>Monitor</a></h2>
                        </div>
                    </div>
                    <!--/panel name-->

                    <div class="span6">
                        <!--panel search-->
                        <div class="panel-search">
                            <form />
                                <div class="input-icon-append">
                                    <button type="submit" rel="tooltip-bottom" title="search" class="icon"><i class="icofont-search"></i></button>
                                    <input class="input-large search-query grd-white" maxlength="23" placeholder="Search here..." type="text" />
                                </div>
                            </form>
                        </div><!--/panel search-->
                    </div>
                    <div class="span4">
                        <!--panel button ext-->
                        <div class="panel-ext">
                            <div class="btn-group">
                                <!--notification-->
                                <a class="btn btn-danger btn-small" data-toggle="dropdown" href="#" title="3 notification">3</a>
                                <ul class="dropdown-menu dropdown-notification">
                                    <li class="dropdown-header grd-white"><a href="#">View All Notifications</a></li>
                                    <li class="new">
                                        <a href="#">
                                            <div class="notification"><?php echo $user->name ?> commented on a post</div>
                                            <div class="media">
                                                <img class="media-object pull-left" data-src="../js/holder.js/64x64" />
                                                <div class="media-body">
                                                    <h4 class="media-heading">Lorem ipsum <small class="helper-font-small"> <?php echo $user->name ?></small></h4>
                                                    <p>Raw denim you probably haven't heard of them jean shorts Austin.</p>
                                                </div>
                                            </div>
                                        </a>
                                    </li>
                                    <li class="new">
                                        <a href="#">
                                            <div class="notification">Request new order</div>
                                            <div class="media">
                                                <img class="media-object pull-left" data-src="../js/holder.js/64x64" />
                                                <div class="media-body">
                                                    <h4 class="media-heading">Tortor dapibus</h4>
                                                    <p>Vegan fanny pack odio cillum wes anderson 8-bit.</p>
                                                </div>
                                            </div>
                                        </a>
                                    </li>
                                    <li class="new">
                                        <a href="#">
                                            <div class="notification">Request new order</div>
                                            <div class="media">
                                                <img class="media-object pull-left" data-src="../js/holder.js/64x64" />
                                                <div class="media-body">
                                                    <h4 class="media-heading">Lacinia non</h4>
                                                    <p>Messenger bag gentrify pitchfork tattooed craft beer.</p>
                                                </div>
                                            </div>
                                        </a>
                                    </li>
                                    <li>
                                        <a href="#">
                                            <div class="notification"><?php echo $user->name ?> commented on a post</div>
                                            <div class="media">
                                                <img class="media-object pull-left" data-src="../js/holder.js/64x64" />
                                                <div class="media-body">
                                                    <h4 class="media-heading">Lorem ipsum <small class="helper-font-small"> <?php echo $user->name ?></small></h4>
                                                    <p>Raw denim you probably haven't heard of them jean shorts Austin.</p>
                                                </div>
                                            </div>
                                        </a>
                                    </li>
                                    <li>
                                        <a href="#">
                                            <div class="notification">Request new order</div>
                                            <div class="media">
                                                <img class="media-object pull-left" data-src="../js/holder.js/64x64" />
                                                <div class="media-body">
                                                    <h4 class="media-heading">Tortor dapibus</h4>
                                                    <p>Vegan fanny pack odio cillum wes anderson 8-bit.</p>
                                                </div>
                                            </div>
                                        </a>
                                    </li>
                                    <li>
                                        <a href="#">
                                            <div class="notification">Request new order</div>
                                            <div class="media">
                                                <img class="media-object pull-left" data-src="../js/holder.js/64x64" />
                                                <div class="media-body">
                                                    <h4 class="media-heading">Lacinia non</h4>
                                                    <p>Messenger bag gentrify pitchfork tattooed craft beer.</p>
                                                </div>
                                            </div>
                                        </a>
                                    </li>
                                    <!-- <li class="dropdown-footer"><a href=""></a></li> -->
                                </ul><!--notification-->
                            </div>
                            <div class="btn-group">
                                <a class="btn btn-inverse btn-small dropdown-toggle" data-toggle="dropdown" href="#">
                                    Shortcut
                                </a>
                                <ul class="dropdown-menu" role="menu" aria-labelledby="dLabel">
                                    <li><a tabindex="-1" href="calendar.html">Calendar</a></li>
                                    <li><a tabindex="-1" href="invoice.html">Invoice</a></li>
                                    <li><a tabindex="-1" href="message.html">Message</a></li>
                                    <li class="divider"></li>
                                    <li class="dropdown-submenu">
                                        <a tabindex="-1" href="#">Sample Page</a>
                                        <ul class="dropdown-menu">
                                            <li><a tabindex="-1" href="pricing.html">Pricing</a></li>
                                            <li><a tabindex="-1" href="bonus-page/resume/index.html">Resume</a></li>
                                        </ul>
                                    </li>
                                    <li class="dropdown-submenu">
                                        <a tabindex="-1" href="#">Error Page</a>
                                        <ul class="dropdown-menu">
                                            <li><a tabindex="-1" href="403.html">Error 403</a></li>
                                            <li><a tabindex="-1" href="404.html">Error 404</a></li>
                                            <li><a tabindex="-1" href="405.html">Error 405</a></li>
                                            <li><a tabindex="-1" href="500.html">Error 500</a></li>
                                            <li><a tabindex="-1" href="503.html">Error 503</a></li>
                                            <li><a tabindex="-1" href="under-construction.html">Under Construction</a></li>
                                            <li><a tabindex="-1" href="coming-son.html">Coming Son</a></li>
                                        </ul>
                                    </li>
                                    <li class="divider"></li>
                                    <li><a tabindex="-1" href="#">Something else here</a></li>
                                </ul>
                            </div>
                            <div class="btn-group">
                                <a class="btn btn-inverse btn-small" href="#">Other Action</a>
                            </div>
                            <div class="btn-group user-group">
                                <a class="dropdown-toggle" data-toggle="dropdown" href="#">
                                    <img class="corner-all" align="middle" src="../img/user-thumb.jpg" title="<?php echo $user->name ?>" alt="<?php echo $user->name ?>" /> <!--this for display on PC device-->
                                    <button class="btn btn-small btn-inverse"><?php echo $user->name ?></button> <!--this for display on tablet and phone device-->
                                </a>
                                <ul class="dropdown-menu dropdown-user" role="menu" aria-labelledby="dLabel">
                                    <li>
                                        <div class="media">
                                            <a class="pull-left" href="#">
                                                <img class="../img-circle" src="../img/user.jpg" title="profile" alt="profile" />
                                            </a>
                                            <div class="media-body description">
                                                <p><strong><?php echo $user->name ?></strong></p>
                                                <p class="muted"><?php echo $user->email ?></p>
                                                <?php
                                                if($isAdmin){
                                                ?>                                                    
                                                    <p><a role="button" class="btn btn-link" style="padding-left:0;" data-toggle="modal" href="#myModalConfiguration">Setting</a></p>
                                                <?php
                                                }
                                                ?>
                                                <a class="btn btn-primary btn-small btn-block">View Profile</a>
                                            </div>
                                        </div>
                                    </li>
                                    <li class="dropdown-footer">
                                        <div>
                                            <a class="btn btn-small pull-right" href="/pages/logout.php">Logout</a>
                                            <a class="btn btn-small" href="#">Add Account</a>
                                        </div>
                                    </li>
                                </ul>
                            </div>
                        </div><!--panel button ext-->
                    </div>
                </div>
            </div><!--/nav bar helper-->
        </header>

        <!-- Modal-->
        <div id="myModalConfiguration" style="height:580px;" class="modal hide fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                <h3>Company</h3>
            </div>
            <div style="position: relative;overflow-y: auto;padding: 15px;max-height:490px;" class="content-modal">
                <form class="form-horizontal" style="height:470px;" id="form-validate-company" action="" method="post" />
                    <table>
                        <tr>
                            <td colspan="2" style="text-align:center"><h4>Activation code:&nbsp;<?php echo $company->code ?></h4></td>
                        </tr>
                        <tr>
                            <td>Name</td>
                            <td>
                                <input  type="text" id="txtCompanyName" name="txtCompanyName" data-validate="{required: true, messages:{required:'Please enter field required'}}" class="grd-white" value="<?php echo $company->name ?>" />
                            </td>    
                        </tr>
                        <tr style="display:none;">
                            <td>Logo</td>
                            <td>
                                <p>
                                <input type="file" id="txtCompanyLogo" name="txtCompanyLogo" class="smallinput" accept="image/*" value=""/>
                                </p>
                                <p>
                                    <span style="color:#999;" class="helper-font-small">Logo of company</span>
                                </p>
                                <span class="field">
                                    <?php echo '<p><img src="data:'.$company->logo_type.';base64,' . base64_encode( $company->logo ) . '" width="150px" height="60px" /></p>'; ?>
                                </span>
                            </td>    
                        </tr>
                        <tr>
                            <td>GPS update interval</td>
                            <td>
                                <p>
                                    <input  type="text" id="txtCompanyGps_time" onKeyPress="return soloNumeros(event)" data-validate="{required: true, messages:{required:'Please enter field required'}}" name="txtCompanyGps_time" style="border: 0; color: #f6931f; font-weight: bold; width: 50px !important;" value="<?php echo $company->gps_time ?>"/>
                                    <span for="amount-max" class="helper-font-small">Max. 100:</span>
                                </p>
                                <div style="width:300px !important;" id="slider-CompanyGps_time" class="slider-orange"></div>
                                <span style="color:#999;" class="helper-font-small">In seconds</span>
                            </td>
                        </tr>
                        <tr>
                            <td>Minimum displacement</td>
                            <td>
                                <p>
                                    <input  type="text" id="txtCompanyGps_distance" onKeyPress="return soloNumeros(event)" data-validate="{required: true, messages:{required:'Please enter field required'}}" name="txtCompanyGps_distance" style="border: 0; color: #f6931f; font-weight: bold; width: 50px !important;" value="<?php echo $company->gps_distance ?>"/>
                                    <span for="amount-max" class="helper-font-small">Max. 100:</span>
                                </p>
                                <div style="width:300px !important;" id="slider-CompanyGps_distance" class="slider-orange"></div>
                                <span style="color:#999;" class="helper-font-small">In meters</span>
                            </td>
                        </tr>
                        <tr>
                            <td>Interval for idle users</td>
                            <td>
                                <p>
                                    <input type="text" id="txtCompanyIdle_time" onKeyPress="return soloNumeros(event)" data-validate="{required: true, messages:{required:'Please enter field required'}}" name="txtCompanyIdle_time" style="border: 0; color: #f6931f; font-weight: bold; width: 50px !important;" value="<?php echo $company->idle_time ?>" />
                                    <span for="amount-max" class="helper-font-small">Max. 100:</span>
                                </p>
                                <div style="width:300px !important;" id="slider-CompanyIdle_time" class="slider-orange"></div>
                                <span style="color:#999;" class="helper-font-small">User marked in yellow on the map, in minutes</span>
                            </td>
                        </tr>
                        <tr>
                            <td>Interval for inactive user</td>
                            <td>
                                <p>
                                    <input type="text" id="txtCompanyInactive_time" onKeyPress="return soloNumeros(event)" data-validate="{required: true, messages:{required:'Please enter field required'}}" name="txtCompanyInactive_time" style="border: 0; color: #f6931f; font-weight: bold; width: 50px !important;" value="<?php echo $company->inactive_time ?>" />
                                    <span for="amount-max" class="helper-font-small">Max. 100:</span>
                                </p>
                                <div style="width:300px !important;" id="slider-CompanyInactive_time" class="slider-orange"></div>
                                <span style="color:#999;" class="helper-font-small">User marked in red on the map, in minutes</span>
                            </td>
                        </tr>
                        <tr>
                            <td></td>
                            <td><button class="btn" data-dismiss="modal" aria-hidden="true">Close</button>
                            <button class="btn btn-primary" id="btnSaveCompany" name="action" value="SaveCompany">Save</button></td>
                        </tr>
                    </table>
                </form>
            </div>
        </div>

        <script type="text/javascript">
            $(document).ready(function() {

                // slider with max
                $("#slider-CompanyGps_time").slider({
                    range: "max",
                    min: 1,
                    max: 100,
                    value: $("#txtCompanyGps_time").val(),
                    slide: function( event, ui ) {
                        $( "#txtCompanyGps_time" ).val( ui.value );
                    }
                });
                //$( "#txtCompanyGps_time" ).val( $( "#slider-CompanyGps_time" ).slider( "value" ) );
                $("#slider-CompanyGps_distance").slider({
                    range: "max",
                    min: 1,
                    max: 100,
                    value: $("#txtCompanyGps_distance").val(),
                    slide: function( event, ui ) {
                        $( "#txtCompanyGps_distance" ).val( ui.value );
                    }
                });
                //$( "#txtCompanyGps_distance" ).val( $( "#slider-CompanyGps_distance" ).slider( "value" ) );
                $("#slider-CompanyIdle_time").slider({
                    range: "max",
                    min: 1,
                    max: 100,
                    value: $( "#txtCompanyIdle_time" ).val(),
                    slide: function( event, ui ) {
                        $( "#txtCompanyIdle_time" ).val( ui.value );
                    }
                });
                //$( "#txtCompanyIdle_time" ).val( $( "#slider-CompanyIdle_time" ).slider( "value" ) );
                $("#slider-CompanyInactive_time").slider({
                    range: "max",
                    min: 1,
                    max: 100,
                    value: $( "#txtCompanyInactive_time" ).val(),
                    slide: function( event, ui ) {
                        $( "#txtCompanyInactive_time" ).val( ui.value );
                    }
                });
                //$( "#txtCompanyInactive_time" ).val( $( "#slider-CompanyInactive_time" ).slider( "value" ) );

                $('#form-validate-company').validate();

            })
        </script>