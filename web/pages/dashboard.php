<?php
require_once("../config.php");

?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8" />
        <title>Dashboard - Stilearn Admin Bootstrap</title>
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
        <link href="../css/fullcalendar.css" rel="stylesheet" />
        <link href="../css/bootstrap-wysihtml5.css" rel="stylesheet" />

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
                                <li><a href="index.html"><i class="icofont-home"></i> Dashboard</a> <span class="divider">&rsaquo;</span></li>
                                <li class="active">Dashboard</li>
                            </ul><!--/breadcrumb-->
                        </div><!-- /content-breadcrumb -->
                        
                        <!-- content-body -->
                        <div class="content-body">
                            <!-- dashboard -->
                            <!-- tab stat -->
                            <div class="box-tab corner-all">
                                <div class="box-header corner-top">
                                    <div class="header-control pull-right">
                                        <a data-box="collapse"><i class="icofont-caret-up"></i></a>
                                    </div>
                                    <ul class="nav nav-tabs" id="tab-stat">
                                        <li class="active"><a data-toggle="tab" href="#account-stat">Account Stat</a></li>
                                        <li><a data-toggle="tab" href="#umobile-stat">Users Mobile Stat</a></li>
                                    </ul>
                                </div>
                                <div class="box-body">
                                    <div class="tab-content">
                                        <div class="tab-pane fade in active" id="account-stat">
                                            <div class="row-fluid">
                                                <div class="span4">
                                                    <div class="dashboard-stat">
                                                        <div id="visitor-stat" class="chart" style="height: 120px;"></div>
                                                        <div class="stat-label grd-green color-white">Users Mobile</div>
                                                    </div>
                                                </div>
                                                <div class="span4">
                                                    <div class="dashboard-stat">
                                                        <div id="order-stat" class="chart" style="height: 120px;"></div>
                                                        <div class="stat-label grd-teal color-white">Users Web</div>
                                                    </div>
                                                </div>
                                                <div class="span4">
                                                    <div class="dashboard-stat">
                                                        <div id="user-stat" class="chart" style="height: 120px;"></div>
                                                        <div class="stat-label grd-red color-white">Invoices</div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="tab-pane fade" id="umobile-stat">
                                            <div class="row-fluid">
                                                <div class="span4">
                                                    <div class="dashboard-stat" rel="tooltip" title="usage 2465kb of 5000kb">
                                                        <input data-chart="knob" type="text" data-readonly="true" data-width="120" data-height="120" data-fgcolor="#00A600" value="2465" data-min="0" data-max="5000" />
                                                        <div class="stat-label grd-green color-white">Monthly Bandwidth</div>
                                                    </div>
                                                </div>
                                                <div class="span4">
                                                    <div class="dashboard-stat" rel="tooltip" title="usage 8795kb of 10000kb">
                                                        <input data-chart="knob" type="text" data-readonly="true" data-width="120" data-height="120" data-fgcolor="#00A0B1" value="8795" data-min="0" data-max="10000" />
                                                        <div class="stat-label grd-teal color-white">Disk Space</div>
                                                    </div>
                                                </div>
                                                <div class="span4">
                                                    <div class="dashboard-stat" rel="tooltip" title="server condition 70%, it's good!">
                                                        <input data-chart="knob" type="text" data-readonly="true" data-width="120" data-height="120" data-fgcolor="#AC193D" value="70" data-min="0" data-max="100" />
                                                        <div class="stat-label grd-red color-white">Server Health</div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div><!-- /tab stat -->

                            <!-- tab resume content -->
                            <div class="row-fluid">
                                <!-- tab resume update -->
                                <div class="span6">
                                    <div class="box-tab corner-all">
                                        <div class="box-header corner-top">
                                            <!--tab action-->
                                            <div class="header-control pull-right">
                                                <a data-box="collapse"><i class="icofont-caret-up"></i></a>
                                                <a data-box="close" data-hide="rotateOutDownLeft">&times;</a>
                                            </div>
                                            <ul class="nav nav-pills">
                                                <!--tab menus-->
                                                <li class="active"><a data-toggle="tab" href="#recent-orders">Recent Orders</a></li>
                                                <li><a data-toggle="tab" href="#recent-posts">Recent Posts</a></li>
                                                <li><a data-toggle="tab" href="#recent-comments">Recent Comments</a></li><!--/tab menus-->
                                            </ul>
                                        </div>
                                        <div class="box-body">
                                            <!-- widgets-tab-body -->
                                            <div class="tab-content">
                                                <div class="tab-pane fade in active" id="recent-orders">
                                                    <div class="media">
                                                        <a class="pull-left" href="#">
                                                            <img class="media-object" data-src="js/holder.js/64x64" />
                                                        </a>
                                                        <div class="media-body">
                                                            <h4 class="media-heading"><a href="#">Lorem ipsum </a><small class="helper-font-small">by john doe on 22 aug 2012, ip 192.168.56.7</small></h4>
                                                            <p>Raw denim you probably haven't heard of them jean shorts Austin.</p>
                                                            <div class="btn-group pull-right">
                                                                <a href="#" class="btn btn-mini">Approve</a>
                                                                <a href="#" class="btn btn-mini">Invoice</a>
                                                                <a href="#" class="btn btn-mini btn-danger">Delete</a>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="media">
                                                        <a class="pull-left" href="#">
                                                            <img class="media-object" data-src="js/holder.js/64x64" />
                                                        </a>
                                                        <div class="media-body">
                                                            <h4 class="media-heading"><a href="#">Lorem ipsum </a><small class="helper-font-small">by jane smith on 18 aug 2012, ip 192.168.56.7</small></h4>
                                                            <p>Food truck fixie locavore, accusamus mcsweeney's marfa nulla single-origin coffee squid.</p>
                                                            <div class="btn-group pull-right">
                                                                <a href="#" class="btn btn-mini">Approve</a>
                                                                <a href="#" class="btn btn-mini">Invoice</a>
                                                                <a href="#" class="btn btn-mini btn-danger">Delete</a>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="media">
                                                        <a class="pull-left" href="#">
                                                            <img class="media-object" data-src="js/holder.js/64x64" />
                                                        </a>
                                                        <div class="media-body">
                                                            <h4 class="media-heading"><a href="#">Lorem ipsum </a><small class="helper-font-small">by john smith on 18 aug 2012, ip 192.168.56.7</small></h4>
                                                            <p>Etsy mixtape wayfarers, ethical wes anderson tofu before they sold out mcsweeney's organic lomo retro fanny pack lo-fi farm-to-table readymade.</p>
                                                            <div class="btn-group pull-right">
                                                                <a href="#" class="btn btn-mini">Approve</a>
                                                                <a href="#" class="btn btn-mini">Invoice</a>
                                                                <a href="#" class="btn btn-mini btn-danger">Delete</a>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <a href="#" class="btn btn-small btn-link pull-right">View all &rarr;</a>
                                                </div>
                                                <div class="tab-pane fade" id="recent-posts">
                                                    <div class="media">
                                                        <a class="pull-left" href="#">
                                                            <img class="media-object" data-src="js/holder.js/64x64" />
                                                        </a>
                                                        <div class="media-body">
                                                            <h4 class="media-heading"><a href="#">Tortor dapibus </a><small class="helper-font-small">by jane smith on 11 aug 2012, ip 192.168.56.7</small></h4>
                                                            <p>Etsy mixtape wayfarers, ethical wes anderson tofu before they sold out mcsweeney's organic lomo retro fanny pack lo-fi farm-to-table readymade.</p>
                                                            <div class="btn-group pull-right">
                                                                <a href="#" class="btn btn-mini">Edit</a>
                                                                <a href="#" class="btn btn-mini">Draft</a>
                                                                <a href="#" class="btn btn-mini btn-danger">Delete</a>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="media">
                                                        <a class="pull-left" href="#">
                                                            <img class="media-object" data-src="js/holder.js/64x64" />
                                                        </a>
                                                        <div class="media-body">
                                                            <h4 class="media-heading"><a href="#">Tortor dapibus </a><small class="helper-font-small">by john doe on 10 aug 2012, ip 192.168.56.7</small></h4>
                                                            <p>Vegan fanny pack odio cillum wes anderson 8-bit, sustainable jean shorts beard ut DIY ethical culpa terry richardson biodiesel.</p>
                                                            <div class="btn-group pull-right">
                                                                <a href="#" class="btn btn-mini">Edit</a>
                                                                <a href="#" class="btn btn-mini">Draft</a>
                                                                <a href="#" class="btn btn-mini btn-danger">Delete</a>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="media">
                                                        <a class="pull-left" href="#">
                                                            <img class="media-object" data-src="js/holder.js/64x64" />
                                                        </a>
                                                        <div class="media-body">
                                                            <h4 class="media-heading"><a href="#">Tortor dapibus </a><small class="helper-font-small">by jane doe on 9 aug 2012, ip 192.168.56.7</small></h4>
                                                            <p>Messenger bag gentrify pitchfork tattooed craft beer, iphone skateboard locavore carles etsy salvia banksy hoodie helvetica. DIY synth PBR banksy irony. Leggings gentrify squid 8-bit cred pitchfork.</p>
                                                            <div class="btn-group pull-right">
                                                                <a href="#" class="btn btn-mini">Edit</a>
                                                                <a href="#" class="btn btn-mini">Draft</a>
                                                                <a href="#" class="btn btn-mini btn-danger">Delete</a>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <a href="#" class="btn btn-small btn-link pull-right">View all &rarr;</a>
                                                </div>
                                                <div class="tab-pane fade" id="recent-comments">
                                                    <div class="media">
                                                        <a class="pull-left" href="#">
                                                            <img class="media-object" data-src="js/holder.js/64x64" />
                                                        </a>
                                                        <div class="media-body">
                                                            <h4 class="media-heading"><a href="#">Lacinia non </a><small class="helper-font-small">by jane smith on 20 aug 2012, ip 192.168.56.7</small></h4>
                                                            <p>Raw denim you probably haven't heard of them jean shorts Austin.</p>
                                                            <div class="btn-group pull-right">
                                                                <a href="#" class="btn btn-mini">Approve</a>
                                                                <a href="#" class="btn btn-mini">Spam</a>
                                                                <a href="#" class="btn btn-mini btn-danger">Delete</a>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="media">
                                                        <a class="pull-left" href="#">
                                                            <img class="media-object" data-src="js/holder.js/64x64" />
                                                        </a>
                                                        <div class="media-body">
                                                            <h4 class="media-heading"><a href="#">Lacinia non </a><small class="helper-font-small">by john smith on 19 aug 2012, ip 192.168.56.7</small></h4>
                                                            <p>Food truck fixie locavore, accusamus mcsweeney's marfa nulla single-origin coffee squid.</p>
                                                            <div class="btn-group pull-right">
                                                                <a href="#" class="btn btn-mini">Approve</a>
                                                                <a href="#" class="btn btn-mini">Spam</a>
                                                                <a href="#" class="btn btn-mini btn-danger">Delete</a>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="media">
                                                        <a class="pull-left" href="#">
                                                            <img class="media-object" data-src="js/holder.js/64x64" />
                                                        </a>
                                                        <div class="media-body">
                                                            <h4 class="media-heading"><a href="#">Lacinia non </a><small class="helper-font-small">by john doe on 17 aug 2012, ip 192.168.56.7</small></h4>
                                                            <p>Messenger bag gentrify pitchfork tattooed craft beer, iphone skateboard locavore carles etsy salvia banksy hoodie helvetica. DIY synth PBR banksy irony. Leggings gentrify squid 8-bit cred pitchfork.</p>
                                                            <div class="btn-group pull-right">
                                                                <a href="#" class="btn btn-mini">Approve</a>
                                                                <a href="#" class="btn btn-mini">Spam</a>
                                                                <a href="#" class="btn btn-mini btn-danger">Delete</a>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <a href="#" class="btn btn-small btn-link pull-right">View all &rarr;</a>
                                                </div>
                                            </div><!--/widgets-tab-body-->
                                        </div><!--/box-body-->
                                    </div><!--/box-tab-->
                                </div><!-- tab resume update -->
                                <div class="span6">
                                    <div class="box corner-all">
                                        <div class="box-header corner-top grd-white">
                                            <div class="header-control">
                                                <a data-box="collapse"><i class="icofont-caret-up"></i></a>
                                                <a data-box="close" data-hide="rotateOutDownRight">&times;</a>
                                            </div>
                                            <span><i class="icofont-envelope"></i> Quick Mail</span>
                                        </div>
                                        <div class="box-body">
                                            <form />
                                                <div class="control-group">
                                                    <label class="control-label">To</label>
                                                    <div class="controls">
                                                        <input type="hidden" class="input-block-level" name="reseiver" value="johndoe@mail.com, janedoe@mail.com, johnsmith@mail.com, janesmith@mail.com" />
                                                    </div>
                                                </div>
                                                <div class="control-group">
                                                    <label class="control-label">Subject</label>
                                                    <div class="controls">
                                                        <input type="text" class="input-block-level grd-white" name="subject" />
                                                    </div>
                                                </div>
                                                <div class="control-group">
                                                    <label class="control-label">Message</label>
                                                    <div class="controls">
                                                        <textarea name="message" data-form="wysihtml5" rows="6" class="span11"></textarea>
                                                    </div>
                                                </div>
                                                <div class="form-actions">
                                                    <input type="reset" class="btn" value="Reset" />
                                                    <input type="submit" class="btn btn-primary" value="Submit" />
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </div><!-- tab stat -->
                            <!--/dashboard-->
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
        <script src="../js/jquery.js"></script>
        <script src="../js/jquery-ui.min.js"></script>
        <script src="../js/bootstrap.js"></script>
        <script src="../js/uniform/jquery.uniform.js"></script>
        <script src="../js/peity/jquery.peity.js"></script>

        <script src="../js/select2/select2.js"></script>
        <script src="../js/knob/jquery.knob.js"></script>
        <script src="../js/flot/jquery.flot.js"></script>
        <script src="../js/flot/jquery.flot.resize.js"></script>
        <script src="../js/flot/jquery.flot.categories.js"></script>
        <script src="../js/wysihtml5/wysihtml5-0.3.0.js"></script>
        <script src="../js/wysihtml5/bootstrap-wysihtml5.js"></script>
        <script src="../js/calendar/fullcalendar.js"></script> <!-- this plugin required jquery ui-->

        <!-- required stilearn template js, for full feature-->
        <script src="../js/holder.js"></script>
        <script src="../js/stilearn-base.js"></script>

        <script type="text/javascript">
            $(document).ready(function() {
                // try your js
                
                // normalize event tab-stat, we hack something here couse the flot re-draw event is any some bugs for this case
                $('#tab-stat > a[data-toggle="tab"]').on('shown', function(){
                    if(sessionStorage.mode == 4){ // this hack only for mode side-only
                        $('body,html').animate({
                            scrollTop: 0
                        }, 'slow');
                    }
                });
                
                // peity chart
                $("span[data-chart=peity-bar]").peity("bar");
                
                // Input tags with select2
                $('input[name=reseiver]').select2({
                    tags:[]
                });
                
                // uniform
                $('[data-form=uniform]').uniform();
                
                // wysihtml5
                $('[data-form=wysihtml5]').wysihtml5()
                toolbar = $('[data-form=wysihtml5]').prev();
                btn = toolbar.find('.btn');
                
                $.each(btn, function(k, v){
                    $(v).addClass('btn-mini')
                });
                
                // Server stat circular by knob
                $("input[data-chart=knob]").knob();
                
                // system stat flot
                d1 = [ ['jan', 231], ['feb', 243], ['mar', 323], ['apr', 352], ['maj', 354], ['jun', 467], ['jul', 429] ];
                d2 = [ ['jan', 87], ['feb', 67], ['mar', 96], ['apr', 105], ['maj', 98], ['jun', 53], ['jul', 87] ];
                d3 = [ ['jan', 34], ['feb', 27], ['mar', 46], ['apr', 65], ['maj', 47], ['jun', 79], ['jul', 95] ];
                
                var visitor = $("#visitor-stat"),
                order = $("#order-stat"),
                user = $("#user-stat"),
                
                data_visitor = [{
                        data: d1,
                        color: '#00A600'
                    }],
                data_order = [{
                        data: d2,
                        color: '#2E8DEF'
                    }],
                data_user = [{
                        data: d3,
                        color: '#DC572E'
                    }],
                 
                
                options_lines = {
                    series: {
                        lines: {
                            show: true,
                            fill: true
                        },
                        points: {
                            show: true
                        },
                        hoverable: true
                    },
                    grid: {
                        backgroundColor: '#FFFFFF',
                        borderWidth: 1,
                        borderColor: '#CDCDCD',
                        hoverable: true
                    },
                    legend: {
                        show: false
                    },
                    xaxis: {
                        mode: "categories",
                        tickLength: 0
                    },
                    yaxis: {
                        autoscaleMargin: 2
                    }
        
                };
                
                // render stat flot
                $.plot(visitor, data_visitor, options_lines);
                $.plot(order, data_order, options_lines);
                $.plot(user, data_user, options_lines);
                
                // tootips chart
                function showTooltip(x, y, contents) {
                    $('<div id="tooltip" class="bg-black corner-all color-white">' + contents + '</div>').css( {
                        position: 'absolute',
                        display: 'none',
                        top: y + 5,
                        left: x + 5,
                        border: '0px',
                        padding: '2px 10px 2px 10px',
                        opacity: 0.9,
                        'font-size' : '11px'
                    }).appendTo("body").fadeIn(200);
                }

                var previousPoint = null;
                $('#visitor-stat, #order-stat, #user-stat').bind("plothover", function (event, pos, item) {
                    
                    if (item) {
                        if (previousPoint != item.dataIndex) {
                            previousPoint = item.dataIndex;

                            $("#tooltip").remove();
                            var x = item.datapoint[0].toFixed(2),
                            y = item.datapoint[1].toFixed(2);
                            label = item.series.xaxis.ticks[item.datapoint[0]].label;
                            
                            showTooltip(item.pageX, item.pageY,
                            label + " = " + y);
                        }
                    }
                    else {
                        $("#tooltip").remove();
                        previousPoint = null;            
                    }
                    
                });
                // end tootips chart
            });
      
        </script>
    </body>
</html>
