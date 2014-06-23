<?php
require_once("../config.php");

$dashboard = new dashboard();
$model = $dashboard->get_model_count($company->id);
$manufacturer = $dashboard->get_manufacturer_count($company->id);
$category = $dashboard->get_category_count($company->id);

?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8" />
        <title>Dashboard | FOMonitor</title>
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

        <script src="../js/jquery.js"></script>
        <script src="../js/jquery-ui.min.js"></script>
        <script type="text/javascript">
        var model = <?php echo json_encode($model); ?>;
        var manufacturer = <?php echo json_encode($manufacturer); ?>;
        var category = <?php echo json_encode($category); ?>;
        </script>

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
                            <div class="row-fluid">
                                <div class="span12">
                                    <div class="box corner-all">
                                        <div class="box-header grd-white corner-top">
                                            <div class="header-control">
                                                <a data-box="collapse"><i class="icofont-caret-up"></i></a>
                                                <a data-box="close" data-hide="rotateOut">&times;</a>
                                            </div>
                                            <span>Account Stat</span>
                                        </div>
                                        <div class="box-body">
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
                                    </div>
                                </div>
                            </div>

                            <div class="row-fluid">
                                <div class="span12">
                                    <div class="box corner-all">
                                        <div class="box-header grd-white corner-top">
                                            <div class="header-control">
                                                <a data-box="collapse"><i class="icofont-caret-up"></i></a>
                                                <a data-box="close" data-hide="rotateOut">&times;</a>
                                            </div>
                                            <span>Users Mobile Stat</span>
                                        </div>
                                        <div class="box-body">
                                            <div class="row-fluid">
                                               <div class="span4">
                                                    <div id="umobile-battery" class="chart"></div>
                                                    <div class="stat-label grd-green color-white">Battery</div>
                                                </div>
                                                <div class="span4">
                                                    <div id="umobile-signal" class="chart"></div>
                                                    <div class="stat-label grd-teal color-white">Signal</div>
                                                </div>
                                                <div class="span4">
                                                    <div id="umobile-speed" class="chart"></div>
                                                    <div class="stat-label grd-red color-white">Speed</div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="row-fluid">
                                <div class="span12">
                                    <div class="box corner-all">
                                        <div class="box-header grd-white corner-top">
                                            <div class="header-control">
                                                <a data-box="collapse"><i class="icofont-caret-up"></i></a>
                                                <a data-box="close" data-hide="rotateOut">&times;</a>
                                            </div>
                                            <span>Mobiles Information</span>
                                        </div>
                                        <div class="box-body">
                                            <div class="row-fluid">
                                                <div class="span4">
                                                    <h3>Models</h3>
                                                    <div id="chart-models" class="chart" style="width: 350px;"></div>
                                                </div>
                                                <div class="span4">
                                                    <h3>Brands</h3>
                                                    <div id="chart-brands" class="chart" style="width: 350px;"></div>
                                                </div>
                                                <div class="span4">
                                                    <h3>Categories</h3>
                                                    <div id="chart-categories" class="chart" style="width: 350px;"></div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
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
        <script src="../js/bootstrap.js"></script>
        <script src="../js/uniform/jquery.uniform.js"></script>
        <script src="../js/peity/jquery.peity.js"></script>

        <script src="../js/select2/select2.js"></script>
        <script src="../js/knob/jquery.knob.js"></script>
        <script src="../js/flot/jquery.flot.js"></script>
        <script src="../js/flot/jquery.flot.pie.js"></script>
        <script src="../js/flot/jquery.flot.resize.js"></script>
        <script src="../js/flot/jquery.flot.categories.js"></script>

        <script src="../js/wysihtml5/wysihtml5-0.3.0.js"></script>
        <script src="../js/wysihtml5/bootstrap-wysihtml5.js"></script>

        <script src="../js/validate/jquery.validate.js"></script>
        <script src="../js/validate/jquery.metadata.js"></script>

        <script src="../js/flot/jquery.flot.demo.js"></script>

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
                
                // Input tags with select2
                $('input[name=reseiver]').select2({
                    tags:[]
                });
                
                // uniform
                $('[data-form=uniform]').uniform();
                
                // wysihtml5
                //$('[data-form=wysihtml5]').wysihtml5();

                toolbar = $('[data-form=wysihtml5]').prev();
                btn = toolbar.find('.btn');
                
                $.each(btn, function(k, v){
                    $(v).addClass('btn-mini')
                });
                
                var action = "getDashboardAccountStat";

                jQuery.ajax({
                        url: "/ajax/actions.php",
                        type: "POST",
                        data: {action: action }
                    }).done(function (resp) {
                        var data = jQuery.parseJSON(resp);
                        drawAccountStat1(data);
                    });
                
                function drawAccountStat1(data){
                    
                    var meses = ["","jan", "feb", "mar", "apr", "maj", "jun", "jul", "aug", "sep", "oct", "nov", "dec"];
                    var priceUserWeb = 5, priceUserMobile = 9; cantMonthView = 7;
                    var d1 = new Array(), d2 = new Array(), d3 = new Array();
                    
                    if(data.length < cantMonthView){
                        var cantReg = data.length;
                        var firstMonth = data[0]["dateMonth"];
                        for (var i = cantMonthView-cantReg; i >= 0; i--) {
                            if((firstMonth-1) == 0) firstMonth = 13; firstMonth--;
                        }
                        for (var i = cantMonthView-cantReg; i >= 0; i--) {
                            d1.push([ meses[firstMonth], 0 ]);
                            d2.push([ meses[firstMonth], 0 ]);
                            d3.push([ meses[firstMonth], 0 ]);
                            if((firstMonth+1) == 13) firstMonth = 0;
                            firstMonth++;
                        }
                    }
                    
                    for (var i = data.length-1; i >= 0 ; i--) {
                        d1.push([ meses[data[i]["dateMonth"]], data[i]["u_mobile"] ]);
                        d2.push([ meses[data[i]["dateMonth"]], data[i]["u_web"] ]);
                        d3.push([ meses[data[i]["dateMonth"]], (data[i]["u_web"] * priceUserWeb) + (data[i]["u_mobile"] * priceUserMobile) ]);
                    }

                    // system stat flot
                    //d1 = [ ['jan', 231], ['feb', 243], ['mar', 323], ['apr', 352], ['maj', 354], ['jun', 467], ['jul', 429] ];
                    //d2 = [ ['jan', 87], ['feb', 67], ['mar', 96], ['apr', 105], ['maj', 98], ['jun', 53], ['jul', 87] ];
                    //d3 = [ ['jan', 34], ['feb', 27], ['mar', 46], ['apr', 65], ['maj', 47], ['jun', 79], ['jul', 95] ];
                    
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
                }

                var action = "getLastDataByIdCompany";

                jQuery.ajax({
                        url: "/ajax/actions.php",
                        type: "POST",
                        data: {action: action }
                    }).done(function (resp) {
                        var data = jQuery.parseJSON(resp);
                        drawAccountStat(data);
                    });

                function drawAccountStat(data) {
                    var umbattery_bars = $("#umobile-battery"),
                    umbattery_data_bars = [],
                    umbattery_ticks = [];

                    var umsignal_bars = $("#umobile-signal"),
                    umsignal_data_bars = [],
                    umsignal_ticks = [];

                    var umspeed_bars = $("#umobile-speed"),
                    umspeed_data_bars = [],
                    umspeed_ticks = [];

                    for (var i = 0; i < data.users.length; i++) {
                        umbattery_data_bars[i] = [(data.users[i].batterylevel*100).toFixed(2),i];
                        umsignal_data_bars[i] = [(data.users[i].gsmstrength*100/31).toFixed(2),i];
                        umspeed_data_bars[i] = [(data.users[i].speed* 3.6).toFixed(2),i];

                        umbattery_ticks[i] = [i,data.users[i].name];
                        umsignal_ticks[i] = [i,data.users[i].name];
                        umspeed_ticks[i] = [i,data.users[i].name];
                    }

                    var umbattery_dataSet = [
                        { label: "Battery", data: umbattery_data_bars, color: "#00a600" }
                    ];
                    var umsignal_dataSet = [
                        { label: "Signal", data: umsignal_data_bars, color: "#00a0b1" }
                    ];
                    var umspeed_dataSet = [
                        { label: "Speed", data: umspeed_data_bars, color: "#bf1e4b" }
                    ];

                    umbattery_options_bars = {
                        series: {
                            bars: {
                                show: true
                            }
                        },
                        bars: {
                            align: "center",
                            barWidth: 0.3,
                            horizontal: true
                        },
                        yaxis: {       
                            ticks: umbattery_ticks,
                            tickLength: 0
                        },
                        legend: {
                            show: false
                        },
                        grid: {
                            backgroundColor: '#FFFFFF',
                            borderWidth: 1,
                            borderColor: '#D7D7D7',
                            hoverable: true,
                            clickable: true
                        }
                    };

                    umsignal_options_bars = {
                        series: {
                            bars: {
                                show: true
                            }
                        },
                        bars: {
                            align: "center",
                            barWidth: 0.3,
                            horizontal: true
                        },
                        yaxis: {       
                            ticks: umsignal_ticks,
                            tickLength: 0
                        },
                        legend: {
                            show:false
                        },
                        grid: {
                            backgroundColor: '#FFFFFF',
                            borderWidth: 1,
                            borderColor: '#D7D7D7',
                            hoverable: true,
                            clickable: true
                        }
                    };

                    umspeed_options_bars = {
                        series: {
                            bars: {
                                show: true
                            }
                        },
                        bars: {
                            align: "center",
                            barWidth: 0.3,
                            horizontal: true
                        },
                        yaxis: {       
                            ticks: umspeed_ticks,
                            tickLength: 0
                        },
                        legend: {
                           show: false
                        },
                        grid: {
                            backgroundColor: '#FFFFFF',
                            borderWidth: 1,
                            borderColor: '#D7D7D7',
                            hoverable: true,
                            clickable: true
                        }
                    };

                    // rendering plot bars
                    var umbattery_chart_bars = $.plot(umbattery_bars, umbattery_dataSet, umbattery_options_bars);
                    var umbattery_chart_bars = $.plot(umsignal_bars, umsignal_dataSet, umsignal_options_bars);
                    var umbattery_chart_bars = $.plot(umspeed_bars, umspeed_dataSet, umspeed_options_bars);
                }

                /**PIE CHART Model**/
                var data = [];
                //var colors = [];
                jQuery(model).each(function(i, val){
                    data[i] = { label: val.model, data: Math.floor(val.qntd) };
                    //colors[i] = get_random_color();
                });

                jQuery.plot(jQuery("#chart-models"), data, {
                    //colors: colors,
                    series: {
                        pie: {
                            show: true,
                            radius: 1,
                            tilt: 0.5,
                            label: {
                                show: true,
                                radius: 1,
                                tilt: 0.5,
                                formatter: function (label, series) {
                                    return '<div style="font-size:8pt;text-align:center;padding:2px;color:white;">'+label+'<br/>'+Math.round(series.percent)+'%</div>';
                                },
                                background: { opacity: 0.8 }
                            },
                            combine: {
                                color: '#999',
                                threshold: 0.1
                            }
                        },
                        grid: {
                            backgroundColor: '#FFFFFF',
                            borderWidth: 1,
                            borderColor: '#D7D7D7',
                            hoverable: true,
                            clickable: true
                        },
                        legend: {
                            show: false
                        }
                    }
                });

                /**PIE CHART Brands**/
                var data = [];
                //var colors = [];
                jQuery(manufacturer).each(function(i, val){
                    data[i] = { label: val.manufacturer, data: Math.floor(val.qntd) };
                    //colors[i] = get_random_color();
                });

                jQuery.plot(jQuery("#chart-brands"), data, {
                    //colors: colors,
                    series: {
                        pie: {
                            show: true,
                            radius: 1,
                            tilt: 0.5,
                            label: {
                                show: true,
                                radius: 1,
                                tilt: 0.5,
                                formatter: function (label, series) {
                                    return '<div style="font-size:8pt;text-align:center;padding:2px;color:white;">'+label+'<br/>'+Math.round(series.percent)+'%</div>';
                                },
                                background: { opacity: 0.8 }
                            },
                            combine: {
                                color: '#999',
                                threshold: 0.1
                            }
                        },
                        grid: {
                            backgroundColor: '#FFFFFF',
                            borderWidth: 1,
                            borderColor: '#D7D7D7',
                            hoverable: true,
                            clickable: true
                        },
                        legend: {
                            show: false
                        }
                    }
                });

                /**PIE CHART Categories**/
                var data = [];
                //var colors = [];
                jQuery(category).each(function(i, val){
                    data[i] = { label: val.category, data: Math.floor(val.qntd) };
                    //colors[i] = get_random_color();
                });

                jQuery.plot(jQuery("#chart-categories"), data, {
                    //colors: colors,
                    series: {
                        pie: {
                            show: true,
                            radius: 1,
                            tilt: 0.5,
                            label: {
                                show: true,
                                radius: 1,
                                tilt: 0.5,
                                formatter: function (label, series) {
                                    return '<div style="font-size:8pt;text-align:center;padding:2px;color:white;">'+label+'<br/>'+Math.round(series.percent)+'%</div>';
                                },
                                background: { opacity: 0.8 }
                            },
                            combine: {
                                color: '#999',
                                threshold: 0.1
                            }
                        },
                        grid: {
                            backgroundColor: '#FFFFFF',
                            borderWidth: 1,
                            borderColor: '#D7D7D7',
                            hoverable: true,
                            clickable: true
                        },
                        legend: {
                            show: false
                        }
                    }
                });


                
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
