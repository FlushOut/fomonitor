$(function(){
    // chart
    // data array
    var d1 = [];
    for (var i = 0; i < 14; i += 0.5)
        d1.push([i, Math.sin(i)]);

    var d2 = [[0, 3], [4, 8], [8, 5], [9, 13]];

    var d3 = [];
    for (var i = 0; i < 14; i += 0.5)
        d3.push([i, Math.cos(i)]);

    var d4 = [];
    for (var i = 0; i < 14; i += 0.1)
        d4.push([i, Math.sqrt(i * 10)]);

    var d5 = [];
    for (var i = 0; i < 14; i += 0.5)
        d5.push([i, Math.sqrt(i)]);

    var d6 = [];
    for (var i = 0; i < 14; i += 0.5 + Math.random())
        d6.push([i, Math.sqrt(2*i + Math.sin(i) + 5)]);
                
    var d7 = [];
    for (var i = 0; i <= 10; i += 1)
        d7.push([i, parseInt(Math.random() * 30)]);

    var d8 = [];
    for (var i = 0; i <= 10; i += 1)
        d8.push([i, parseInt(Math.random() * 30)]);

    var d9 = [];
    for (var i = 0; i <= 10; i += 1)
        d9.push([i, parseInt(Math.random() * 30)]);

                
    
                
                
    
    
                
    
    
                
                
    
                
    $(".stackControls input").click(function (e) {
        e.preventDefault();
        stack = $(this).val() == "With stacking" ? true : null;
        plotWithOptions();
    });
    $(".graphControls input").click(function (e) {
        e.preventDefault();
        bars = $(this).val().indexOf("Bars") != -1;
        lines = $(this).val().indexOf("Lines") != -1;
        steps = $(this).val().indexOf("steps") != -1;
        plotWithOptions();
    });
                
    // variable pie
    var pie1 = $("#chart-pie1"),
    pie2 = $("#chart-pie2"),
    pie3 = $("#chart-pie3"),
    data_pie = [],
    series = Math.floor(Math.random()*6)+3;
    for( var i = 0; i<series; i++){
            data_pie[i] = { label: "Series"+(i+1), data: Math.floor(Math.random()*100)+1 }
    }
    options_pie1 = {
        series: {
            pie: { 
                show: true
            }
        },
        grid: {
            backgroundColor: '#FFFFFF',
            borderWidth: 1,
            borderColor: '#D7D7D7',
            hoverable: true,
            clickable: true
        }
    };
    options_pie2 = {
        series: {
            pie: { 
                show: true
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
    };
    options_pie3 = {
        series: {
            pie: {
                show: true,
                radius: 1,
                tilt: 0.5,
                label: {
                    show: true,
                    radius: 1,
                    formatter: function(label, series){
                        return '<div style="font-size:8pt;text-align:center;padding:2px;color:white;">'+label+'<br/>'+Math.round(series.percent)+'%</div>';
                    },
                    background: { opacity: 0.8 }
                },
                combine: {
                    color: '#999',
                    threshold: 0.1
                }
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
    };
    // rendering plot pie
    $.plot(pie1, data_pie, options_pie1);
    $.plot(pie2, data_pie, options_pie2);
    $.plot(pie3, data_pie, options_pie3);
          
    

    
    

})