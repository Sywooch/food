 var latitude = 55.76;
 var longitude = 37.64;
 
 var zoom = 11;
   var yMap;
   
    ymaps.ready(function () {
            yMap = new yMap21();
            yMap.Init(latitude, longitude, zoom, 'map_canvas');
            //yMap.setMarker(latitude, longitude); 
            getMainMarks();
            
    });
             
             
    function getMainMarks(){
        
        $.ajax({
                type: 'GET',
                 dataType : "json",      
                url: '/mainmapitems/',
                
                success: function(data){
                    if (data){
                        yMap.showMarkersSimple(data);
                    }
                }
          });

     
    }             