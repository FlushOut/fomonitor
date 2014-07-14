    
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
                 = new google.maps.DirectionsRenderer({ 'draggable':true }); 
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
        my.maps.map1 = new google.maps.Map(document.getElementById('map_canvas'),
                                           myOptions);
        /*
        var points = [[-23.5970027,-46.6365844],
                                [-23.599737,-46.636525],
                                [-23.60144,-46.6380016],
                                [-23.6041126,-46.6373517],
                                [-23.604077,-46.632513],
                                [-23.6054559,-46.6323238],
                                [-23.605418,-46.635914],
                                [-23.6068253,-46.6374587],
                                [-23.609124,-46.637916],
                                [-23.6103068,-46.6380331],
                                [-23.612904,-46.6378291],
                                [-23.614961,-46.638355],
                                [-23.6152363,-46.6384301],
                                [-23.6174376,-46.6388869],
                                [-23.6172144,-46.6408455],
                                [-23.6169999,-46.6429986],
                                [-23.6178603,-46.6433293],
                                [-23.620495,-46.642578],
                                [-23.6214129,-46.6435843]
                    ];*/
        var points = [[-23.5970027,-46.6365844],[-23.599737,-46.636525],[-23.60144,-46.6380016],[-23.6041126,-46.6373517]];
        my.routes[0] = new Route(points).drawRoute(my.maps.map1);
        /*
        var pointCount = points.lenght;
        var routeCount = Math.ceil(pointCount/10);
        for(routeCount){
        var markers = [];
            for(j<10){
                if(points.lenght>0){
                    markers.push(point[j][0],point[j][1]);
                    points.splice(j,1);
                }
            }
        my.routes[i] = new Route(markers).drawRoute(my.maps.map1);
        }
        */            

        /*my.routes[0] = new Route([
                                  [-23.520553333333336,-46.671215],
                                [-23.518024999999998,-46.678309999999996],
                                [-23.515289999999997,-46.69264],
                                [-23.51516333333333,-46.69304166666667],
                                [-23.515158333333336,-46.692975],
                                [-23.592836,-46.636647],
                                [-23.5909131,-46.6348371]
                                 ]).drawRoute(my.maps.map1);
        my.routes[1] = new Route([
                                  [-23.5970027,-46.6365844],
                                [-23.599737,-46.636525],
                                [-23.60144,-46.6380016],
                                [-23.6041126,-46.6373517],
                                [-23.604077,-46.632513],
                                [-23.6054559,-46.6323238],
                                [-23.605418,-46.635914],
                                [-23.6068253,-46.6374587],
                                [-23.609124,-46.637916],
                                [-23.6103068,-46.6380331]
                                 ]).drawRoute(my.maps.map1);

        my.routes[2] = new Route([
                                  [-23.6103068,-46.6380331],
                                [-23.612904,-46.6378291],
                                [-23.614961,-46.638355],
                                [-23.6152363,-46.6384301],
                                [-23.6174376,-46.6388869],
                                [-23.6172144,-46.6408455],
                                [-23.6169999,-46.6429986],
                                [-23.6178603,-46.6433293],
                                [-23.620495,-46.642578],
                                [-23.6214129,-46.6435843]
                                 ]).drawRoute(my.maps.map1);
    */
      }
      google.maps.event.addDomListener(window, 'load', initialize);




</script>
    <div id="map_canvas" style="height:400px;width:800px;"></div>
    </body>
</html>
