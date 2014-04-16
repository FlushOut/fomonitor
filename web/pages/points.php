<?php require_once("../config.php"); ?>
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
                // MMOYANO: Comentado por no ser usado en la pagina
                //$.plot(visitor, data_visitor, options_lines);
                //$.plot(order, data_order, options_lines);
                //$.plot(user, data_user, options_lines);
                
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
                
                
                // Schedule Calendar
                var date = new Date();
        var d = date.getDate();
        var m = date.getMonth();
        var y = date.getFullYear();
        
                var calendar = $('#schedule').fullCalendar({
                    header: {
                        left: 'title',
                        center: '',
                        right: 'prev,next today,month,basicWeek,basicDay'
                    },
                    events: [
                        {
                            title: 'Start a project',
                            start: new Date(y, m, 1)
                        },
                        {
                            title: 'interview and data collection',
                            start: new Date(y, m, 3),
                            end: new Date(y, m, 7)
                        },
                        {
                            title: 'Creating design interface',
                            start: new Date(y, m, 9),
                            end: new Date(y, m, 12)
                        },
                        {
                            title: 'Meeting',
                            start: new Date(y, m, 19, 10, 30),
                            allDay: false
                        },
                        {
                            title: 'Meeting',
                            start: new Date(y, m, 28, 10, 30),
                            allDay: false
                        },
                        {
                            title: 'Date',
                            start: new Date(y, m, d, 12, 0),
                            end: new Date(y, m, d, 14, 0),
                            allDay: false
                        },
                        {
                            title: 'Birthday Party',
                            start: new Date(y, m, d+1, 19, 0),
                            end: new Date(y, m, d+1, 22, 30),
                            allDay: false
                        }
                    ]
                });
                // end Schedule Calendar
            });
      
        </script>

	</head>
    <body>

        <!-- START OF HEADER -->
        <?php include("../includes/_header.php"); ?>
        <!-- END OF HEADER -->
        <section class="section">
            <div class="row-fluid">
                <!-- START OF MENU -->
                <?php include("../includes/_left_menu.php"); ?>
                <!-- END OF MENU -->

                <!-- span content -->
                <div class="span9">
                    <!-- content -->
                    <div class="content">
                        <!-- content-header -->
                        <div class="content-header">
<!--                             <ul class="content-header-action pull-right">
                                <li>
                                    <a href="#">
                                        <span data-chart="peity-bar" data-height="32" data-colours='["#00A600", "#00A600"]'>5,3,9,6,5,9,7,3,5,2</span>
                                        <div class="action-text color-green">8765 <span class="helper-font-small color-silver-dark">Visits</span></div>
                                    </a>
                                </li>
                                <li class="divider"></li>
                                <li>
                                    <a href="#">
                                        <span data-chart="peity-bar" data-height="32" data-colours='["#00A0B1", "#00A0B1"]'>9,7,9,6,3,5,3,5,5,2</span>
                                        <div class="action-text color-teal">1437 <span class="helper-font-small color-silver-dark">Users</span></div>
                                    </a>
                                </li>
                                <li class="divider"></li>
                                <li>
                                    <a href="#">
                                        <span data-chart="peity-bar" data-height="32" data-colours='["#BF1E4B", "#BF1E4B"]'>6,5,9,7,3,5,2,5,3,9</span>
                                        <div class="action-text color-red">4367 <span class="helper-font-small color-silver-dark">Orders</span></div>
                                    </a>
                                </li>
                            </ul> -->
                            <h2><i class="icofont-home"></i> Points <small>Insert, Update and Delete</small></h2>
                        </div><!-- /content-header -->

                        <!-- content-body -->
                        <div class="content-body">                            

                        </div><!--/content-body -->
                    </div><!-- /content -->
                </div><!-- /span content -->

            </div>
        </section>
        <!-- section footer -->
        <footer>
            <a rel="to-top" href="#top"><i class="icofont-circle-arrow-up"></i></a>
        </footer>

    </body>
</html>