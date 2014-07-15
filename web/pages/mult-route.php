    
<html>
    <body>
    <script src="../js/jquery.js"></script>
    <script src="../js/jquery-ui.min.js"></script>
    <script type="text/javascript"
        src="https://maps.googleapis.com/maps/api/js?sensor=false"></script>
    <script type="text/javascript">
    var my={directionsSVC:new google.maps.DirectionsService(),
              maps:{},
              routes:{}};
    var iniMarker;
    var endMarker;
      
      /**
        * base-class     
        * @param points optional array array of lat+lng-values defining a route
        * @return object Route
        **/                     
      function Route(points)
      {
        this.origin       = null;
        this.destination  = null;
        this.waypoints    = [];
        if(points && points.length>1)
        {
          this.setPoints(points);
        }
        return this; 
      };

      /**
        *  draws route on a map 
        *              
        * @param map object google.maps.Map 
        * @return object Route
        **/                    
      Route.prototype.drawRoute = function(map)
      {
        var _this=this;
        my.directionsSVC.route(
          {'origin': this.origin,
           'destination': this.destination,
           'waypoints': this.waypoints,
           'travelMode': google.maps.DirectionsTravelMode.WALKING
          },
          function(res,sts) 
          {
              if(sts==google.maps.DirectionsStatus.OK){
              if(!_this.directionsRenderer)
              {
                _this.directionsRenderer 
                 = new google.maps.DirectionsRenderer({ 'draggable':false, 'suppressMarkers': true }); 
                              }
                _this.directionsRenderer.setMap(map);
                _this.directionsRenderer.setDirections(res);
                google.maps.event.addListener(_this.directionsRenderer,
                                              'directions_changed',
                                              function()
                                              {
                                                _this.setPoints();
                                              }
                                              );
                          }   
          });
        return _this;
       };

      /**
        * sets map for directionsRenderer     
        * @param map object google.maps.Map
        **/             
      Route.prototype.setGMap = function(map){
        this.directionsRenderer.setMap(map);
      };
      
      /**
        * sets origin, destination and waypoints for a route 
        * from a directionsResult or the points-param when passed    
        * 
        * @param points optional array array of lat+lng-values defining a route
        * @return object Route        
        **/

      Route.prototype.setPoints = function(points)
      {
        this.origin = null;
        this.destination = null;
        this.waypoints = [];

        if(points)
        {
          for(var p=0;p<points.length;++p)
          {
            this.waypoints.push({location:new google.maps.LatLng(points[p][0],
                                                                 points[p][1]),
                                 stopover:false});
          }
          this.origin=this.waypoints.shift().location;
          this.destination=this.waypoints.pop().location;
        }
        else
        {
          var route=this.directionsRenderer.getDirections().routes[0];
          
          for(var l=0;l<route.legs.length;++l)
          {
            if(!this.origin)this.origin=route.legs[l].start_location;
            this.destination = route.legs[l].end_location;
            
            for(var w=0;w<route.legs[l].via_waypoints.length;++w)
            {
              this.waypoints.push({location:route.legs[l].via_waypoints[w],
                                   stopover:false});
            }
          }
          //the route has been modified by the user when you're here
          //you may call now this.getPoints() and work with the result
        }

        return this;
      };
      
      /**
        * retrieves points for a route 
        *         
        * @return array         
        **/
    Route.prototype.getPoints = function()
    {
      var points=[[this.origin.lat(),this.origin.lng()]];
      
      for(var w=0;w<this.waypoints.length;++w)
      {
        points.push([this.waypoints[w].location.lat(),
                     this.waypoints[w].location.lng()]);
      }
      
      points.push([this.destination.lat(),
                   this.destination.lng()]);
      return points;
    };
   
    
    function initialize() 
    {
      var myOptions = {
                        zoom: 8,
                        center: new google.maps.LatLng(-34.397, 150.644),
                        mapTypeId: google.maps.MapTypeId.ROADMAP
                      };
        my.maps.map1 = new google.maps.Map(document.getElementById('map_canvas'),myOptions);
        
        var points = [[-23.5970027,-46.6365844],
                                [-23.599737,-46.636525],
                                [-23.60144,-46.6380016],
                                [-23.6041126,-46.6373517],
                                [-23.604077,-46.632513],
                                [-23.6054559,-46.6323238],
                                [-23.605418,-46.635914],
                                [-23.6068253,-46.6374587],
                                [-23.609124,-46.637916],
                                [-23.6103068,-46.6380331], // 10
                                [-23.612904,-46.6378291],
                                [-23.614961,-46.638355],
                                [-23.6152363,-46.6384301],
                                [-23.6174376,-46.6388869],
                                [-23.6172144,-46.6408455],
                                [-23.6169999,-46.6429986],
                                [-23.6178603,-46.6433293],
                                [-23.620495,-46.642578],
                                [-23.6214129,-46.6435843], 
                                [-23.6223078,-46.6459399], // 20
                                [-23.6234445,-46.6461523],
                                [-23.6262852,-46.6452215],
                                [-23.6278954,-46.6441693],
                                [-23.6252239,-46.6457191],
                                [-23.6237692,-46.6462884],
                                [-23.6213106,-46.6472666],
                                [-23.6192317,-46.6481326],
                                [-23.6166482,-46.6491043],
                                [-23.6153973,-46.6497083],
                                [-23.6142528,-46.6514391],   // 30
                                [-23.6149986,-46.6534291],
                                [-23.6161113,-46.6541687],
                                [-23.6155248,-46.6552928]
                    ];
        
        iniMarker = new google.maps.LatLng(points[0][0],points[0][1]);            
        endMarker = new google.maps.LatLng(points[points.length-1][0],points[points.length-1][1]);            

        var i = 0;
        while (points.length > 0){
          var routePoints = [];
          for ( j = 0; j < 10; j++) {
            if (points[0]) {
              if ( j == 9) {
                routePoints.push([points[0][0],points[0][1]]);
              } else {
                routePoints.push([points[0][0],points[0][1]]);
                points.splice(0,1);
              }
            }
          }
          my.routes[i] = new Route(routePoints).drawRoute(my.maps.map1);
          i++;  
        }
        setIconMarkers();            
      }

      function makeMarker( position, icon, title, name, date ) {
        var marker = new google.maps.Marker({
        position: position,
        map: my.maps.map1,
        icon: icon,
        title: title,
        draggable: false
        });

        var contentString = 
          '<div style="line-height:1.35;overflow:hidden !important;white-space:nowrap;" id="content">'+
              '<div id="siteNotice">'+
              '</div>'+
              '<h2 id="firstHeading" class="firstHeading">'+ name +'</h2>'+
              '<div id="bodyContent">'+
                  '<p><b>Date : </b>'+ date +'&nbsp;&nbsp;</p>'+
              '</div>'+
          '</div>';
        marker.info = new google.maps.InfoWindow({
                        content: contentString
                        });
                        google.maps.event.addListener(marker, "click", function () {
                            marker.info.open(my.maps.map1, marker);
                        });  
      }

      function setIconMarkers()
      {
        var icons = {
        start: new google.maps.MarkerImage(
         '../img/start-route.png',
         new google.maps.Size( 44, 32 ),
         new google.maps.Point( 0, 0 ),
         new google.maps.Point( 22, 32 )
        ),
        end: new google.maps.MarkerImage(
         '../img/finish-route.png',
         new google.maps.Size( 44, 32 ),
         new google.maps.Point( 0, 0 ),
         new google.maps.Point( 22, 32 )
        )
        };
        makeMarker( iniMarker, icons.start, 'Start Route','Jhon','2014-07-15');
        makeMarker( endMarker, icons.end, 'End Route','Jhon','2014-07-15' );
      }

      google.maps.event.addDomListener(window, 'load', initialize);
</script>
    <div id="map_canvas" style="height:400px;width:800px;"></div>
    </body>
</html>
