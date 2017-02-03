/**
 * метод назван как и для google map для совместимости
 */
function yMap21(){


       

    // Карта
    this.map = false;
    this.placemark = false;
    this.placemarksCluster = false;
    this.canvas = '#map_canvas';
    this.markersArray = [];

    // Инициализация и показ карты
    this.Init = function(latitude, longitude, zoom, canvas)
    {
           if (typeof canvas != 'undefined') {
                this.canvas = canvas;       
           }
        
        if (zoom <1) {
            zoom = this.map.getZoom();
        }
        this.map = new ymaps.Map( this.canvas , {
            center: [latitude, longitude],
            zoom: zoom,
            controls: ['zoomControl'],
            type: "yandex#map"
        });
        // this.map = new YMaps.Map(YMaps.jQuery(this.canvas)[0]);

        
        
        //this.map.controls.add(new ymaps.control.ZoomControl());
        this.map.controls.add(new ymaps.control.TypeSelector({
            options: {
                float: 'left'
            }
        }));
        
        
         this.map.setCenter([latitude, longitude]);
        
    }

// Ставим и смотрим координаты маркера
    this.setMarker = function(latitude, longitude)
    {
            var placemark = new YMaps.Placemark(new YMaps.GeoPoint(longitude, latitude), {draggable: true});
            placemark.description = "<p>Перетащите маркер в необходимое место на карте</p>";
            this.map.addOverlay(placemark);
            this.markersArray.push(placemark);
            YMaps.Events.observe(placemark, placemark.Events.DragEnd, function (obj) {
                $('#latitude').val(obj.getGeoPoint().getLat());
                $('#longitude').val(obj.getGeoPoint().getLng());
            });
            /*
            YMaps.Events.observe(this.map, this.map.Events.Update, function (obj) {
              //alert(this.map.Events.Update);
            zoomLevel = this.map.getZoom();
            if ( zoomLevel > 0 )
                $('#map_zoom').val(zoomLevel);
            });*/
    }
    
    this.setMarkerAdv = function(latitude, longitude, description, draggable, icon)
    {
        // Создает стиль
            var s = new YMaps.Style();

            // Создает стиль значка метки
            s.iconStyle = new YMaps.IconStyle();
            s.iconStyle.href = "/themes/portal/images/map/marker-"+icon+".png";
            s.iconStyle.size = new YMaps.Point(20, 27);
            s.iconStyle.offset = new YMaps.Point(-20, -27);
            
            var placemark = new YMaps.Placemark(new YMaps.GeoPoint(longitude, latitude), {draggable: draggable, style:s});
            placemark.description = description;
            this.map.addOverlay(placemark);
            this.markersArray.push(placemark);
            YMaps.Events.observe(placemark, placemark.Events.DragEnd, function (obj) {
                $('#latitude').val(obj.getGeoPoint().getLat());
                $('#longitude').val(obj.getGeoPoint().getLng());
            });
            /*
            YMaps.Events.observe(this.map, this.map.Events.Update, function (obj) {
              //alert(this.map.Events.Update);
            zoomLevel = this.map.getZoom();
            if ( zoomLevel > 0 )
                $('#map_zoom').val(zoomLevel);
            });*/
    }
    
     //Смотрим координаты карты
    this.listPosition = function()
    {
        var map = this.map;
        YMaps.Events.observe(this.map, this.map.Events.DragEnd, function (obj) {
            $('#latitude').val(obj.getCenter().getLat());
            $('#longitude').val(obj.getCenter().getLng());
        });
        YMaps.Events.observe(this.map, this.map.Events.Update, function (obj) {
            zoomLevel = map.getZoom();
            if ( zoomLevel > 0 )
                $('#zoom').val(zoomLevel);
        });

    }
    
    // Показываем маркер
    this.showMarker = function(latitude, longitude , title, content, icon, obj_id, din_type,  dinamic_content)
    {
            // Создает стиль
            var s = {
                    // Опции.
                    // Необходимо указать данный тип макета.
                    iconLayout: 'default#image',
                    // Своё изображение иконки метки.
                    iconImageHref: "/images/marker_"+icon+".png",
                    // Размеры метки.
                    iconImageSize: [32, 41],
                    // Смещение левого верхнего угла иконки относительно
                    // её "ножки" (точки привязки).
                    iconImageOffset: [-11, -11]
        
                };    


           
            // Создаем маркер
            var placemark = new ymaps.Placemark([latitude, longitude], {hintContent: '',  balloonContent: 'ddd'},s);
             this.markersArray.push(placemark);
            // this.map.geoObjects.add(placemark);
             
            
           if (dinamic_content!=undefined && dinamic_content==1){
                    // Обрабатываем событие открытия балуна на геообъекте:
                    // начинаем загрузку данных, затем обновляем его содержимое.
                    placemark.events.add('balloonopen', function (e) {
                        placemark.properties.set('balloonContent', "Идет загрузка данных...");
                        getContent(din_type, obj_id, placemark);

                    });
            }
            
           



    }
    
    // Показываем маркер
    this.showMarkerAdv = function(longitude, latitude, title, content, icon, obj_id, din_type,  dinamic_content)
    {
            // Создает стиль
            var s = new YMaps.Style();

            // Создает стиль значка метки
            s.iconStyle = new YMaps.IconStyle();
            s.iconStyle.href = "/themes/portal/images/map/marker-"+icon+".png";
            s.iconStyle.size = new YMaps.Point(11, 11);
            s.iconStyle.offset = new YMaps.Point(-11, -11);

            // Создаем маркер
            var placemark = new YMaps.Placemark(new YMaps.GeoPoint(latitude, longitude),{style:s});
            //placemark.name = title;
            placemark.description = content;
            //this.map.addOverlay(placemark);
            //this.map.setCenter(new YMaps.GeoPoint(latitude, longitude));
           this.markersArray.push(placemark);

/*
          if (dinamic_content!=undefined && dinamic_content==1){
                YMaps.Events.observe(placemark, placemark.Events.Click, function (e) {

                        getContent(din_type, obj_id, placemark);
                });
            }
            */
        if(this.placemarksCluster){
            this.placemarksCluster.setMarkers(this.markersArray); // добавляем маркерв в кластиризатор
            this.placemarksCluster.repaint(); // обнавляем кластеры на карте
        }else{
            // создать clusterer объект с определенными параметрами
            var opts = {
                bath:300,
                grid: 50

            };

            this.placemarksCluster = new YandexClusterer(this.map, [], opts);
            this.placemarksCluster.setMarkers(this.markersArray); // добавляем маркерв в кластиризатор
            this.placemarksCluster.repaint(); // обнавляем кластеры на карте
        }

    }

    // Показываем массив маркеров
    this.showMarkersSimple = function(obj)
    {
        this.clearOverlays();
        


        for (var i = 0; i < obj.length; i++) {
             if (obj[i].dinamic!=undefined && obj[i].dinamic==1){
                dinamic_content=1;
                type=obj[i].din_type;
            }else{
                type='';
                dinamic_content=0;
            }

            this.showMarker(obj[i].map_latitude, obj[i].map_longitude, obj[i].name, obj[i].content, obj[i].map_icon, obj[i].id, type,  dinamic_content);
        }

        if(this.placemarksCluster){
             this.placemarksCluster.removeAll();
            this.placemarksCluster.add(this.markersArray); // добавляем маркерв в кластиризатор
        }else{
            // создать clusterer объект с определенными параметрами
            var opts = {
                preset: 'islands#darkOrangeClusterIcons',
                bath:300,
                grid: 50

            };

            this.placemarksCluster = new ymaps.Clusterer(opts);
            this.placemarksCluster.add(this.markersArray); // добавляем маркерв в кластиризатор
            this.map.geoObjects.add(this.placemarksCluster);
        }
        
            this.map.setBounds( this.placemarksCluster.getBounds(), {
                checkZoomRange: true
            });
        
    }
    // Показываем массив маркеров
    this.showMarkers = function(obj)
    {
        this.clearOverlays();
        var msie = YMaps.jQuery.browser.msie;

        for (var i = 0; i < obj.length; i++) {
             if (obj[i].dinamic!=undefined && obj[i].dinamic==1){
                dinamic_content=1;
                type=obj[i].din_type;
            }else{
                type='';
                dinamic_content=0;
            }

            this.showMarker(obj[i].map_latitude, obj[i].map_longitude, obj[i].name, obj[i].content, obj[i].map_icon, obj[i].id, type,  dinamic_content);
        }

        if(this.placemarksCluster){
            this.placemarksCluster.setMarkers(this.markersArray); // добавляем маркерв в кластиризатор
            this.placemarksCluster.repaint(); // обнавляем кластеры на карте
        }else{
            // создать clusterer объект с определенными параметрами
            var opts = {
                bath:300,
                grid: 50

            };

            this.placemarksCluster = new YandexClusterer(this.map, [], opts);
            this.placemarksCluster.setMarkers(this.markersArray); // добавляем маркерв в кластиризатор
            this.placemarksCluster.repaint(); // обнавляем кластеры на карте
        }
    }

    // Очистка всех маркеров
    this.clearOverlays  = function()
    {
        if (this.markersArray) {
            for (i in this.markersArray) {
                this.map.geoObjects.remove(this.markersArray[i]);
            }
            this.markersArray = [];
        }
        
        if(this.placemarksCluster){
            this.placemarksCluster.removeAll();
        }
    }

}

 // получает контент для плашки
 function getContent(type, id, placemark){


       url='';
    if (type=="food"){
        url='/get-one-content-4map/';
        var data =  new Object;
        var coords = placemark.geometry.getCoordinates();
        
        data.latitude = coords[0];
        data.longitude = coords[1];   
        
    }else{
        return;
    }


    
        $.ajax({
                type: 'GET',
                 dataType : "json",      
                url: url,
                data: data,
                success: function(result){
                   if(result.content!=''){
                        placemark.properties.set('balloonContent', result.content);
                     }

                }
          });
 


}