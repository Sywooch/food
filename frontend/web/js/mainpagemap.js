ymaps.ready(init);
var myMap, 
	myPlacemark;

function init() {
	myMap = new ymaps.Map("map_canvas", {
		center: [56.317655,43.994362],
		zoom: 15
	});

	myPlacemark = new ymaps.Placemark([55.76, 37.64], {
		hintContent: 'Москва!',
		balloonContent: '<h4>Москва!</h4><br>Столица России',
	});
	myMap.geoObjects.add(myPlacemark);

	// Рисование полигонов вручную
	// polygon = new ymaps.GeoObject({
	// 	geometry: {
	// 		type: "Polygon",
	// 		coordinates: []
	// 	}
	// });
	// myMap.geoObjects.add(polygon);
	// polygon.editor.startDrawing();


	// Создаем многоугольник
	// myPolygon = new ymaps.Polygon([[
	// 	// Координаты вершин внешней границы многоугольника.
	// 	[56.316797,43.987925],
	// 	[56.316177,43.990586],
	// 	[56.316224,43.995564],
	// 	[56.317703,44.002258],
	// 	[56.319182,44.003288],
	// 	[56.318943,43.997194],
	// 	[56.318514,43.996679],
	// 	[56.320803,43.990071]
	// ]]);
	// myMap.geoObjects.add(myPolygon);


	// Добавление объектов списком на карту
	// objects = ymaps.geoQuery([
	// 	{
	// 		type: 'Point',
	// 		coordinates: [55.73, 37.75]
	// 	},
	// 	{
	// 		type: 'Point',
	// 		coordinates: [55.10, 37.45]
	// 	},
	// 	{
	// 		type: 'Point',
	// 		coordinates: [55.25, 37.35]
	// 	}
	// ]).addToMap(myMap);

	// Задание окружности
	// circle = new ymaps.Circle([[55.43, 37.7], 10000], null, { draggable: true });

	// Определение объектов внутри и снаружи при движении окружности (только из объектов из списка)
	// circle.events.add('drag', function () {
	// 	// Объекты, попадающие в круг, будут становиться красными.
	// 	var objectsInsideCircle = objects.searchInside(circle);
	// 	objectsInsideCircle.setOptions('preset', 'islands#redIcon');
	// 	// Оставшиеся объекты - синими.
	// 	objects.remove(objectsInsideCircle).setOptions('preset', 'islands#blueIcon');
	// });

	// Добавление на карту окружности
	// myMap.geoObjects.add(circle);


	// // Кластеризация
	// /**
	//  * Создадим кластеризатор, вызвав функцию-конструктор.
	//  * Список всех опций доступен в документации.
	//  * @see https://api.yandex.ru/maps/doc/jsapi/2.1/ref/reference/Clusterer.xml#constructor-summary
	//  */
	// clusterer = new ymaps.Clusterer({
	// 	/**
	// 	 * Через кластеризатор можно указать только стили кластеров,
	// 	 * стили для меток нужно назначать каждой метке отдельно.
	// 	 * @see https://api.yandex.ru/maps/doc/jsapi/2.1/ref/reference/option.presetStorage.xml
	// 	 */
	// 	preset: 'islands#invertedVioletClusterIcons',
	// 	/**
	// 	 * Ставим true, если хотим кластеризовать только точки с одинаковыми координатами.
	// 	 */
	// 	groupByCoordinates: false,
	// 	/**
	// 	 * Опции кластеров указываем в кластеризаторе с префиксом "cluster".
	// 	 * @see https://api.yandex.ru/maps/doc/jsapi/2.1/ref/reference/ClusterPlacemark.xml
	// 	 */
	// 	clusterDisableClickZoom: true,
	// 	clusterHideIconOnBalloonOpen: false,
	// 	geoObjectHideIconOnBalloonOpen: false
	// });

	// geoObjects = [];
	// points = [
	// 	[55.831903,37.411961], [55.763338,37.565466], [55.763338,37.565466], [55.744522,37.616378], [55.780898,37.642889], [55.793559,37.435983], [55.800584,37.675638], [55.716733,37.589988], [55.775724,37.560840], [55.822144,37.433781], [55.874170,37.669838], [55.716770,37.482338], [55.780850,37.750210], [55.810906,37.654142], [55.865386,37.713329], [55.847121,37.525797], [55.778655,37.710743], [55.623415,37.717934], [55.863193,37.737000], [55.866770,37.760113], [55.698261,37.730838], [55.633800,37.564769], [55.639996,37.539400], [55.690230,37.405853], [55.775970,37.512900], [55.775777,37.442180], [55.811814,37.440448], [55.751841,37.404853], [55.627303,37.728976], [55.816515,37.597163], [55.664352,37.689397], [55.679195,37.600961], [55.673873,37.658425], [55.681006,37.605126], [55.876327,37.431744], [55.843363,37.778445], [55.875445,37.549348], [55.662903,37.702087], [55.746099,37.434113], [55.838660,37.712326], [55.774838,37.415725], [55.871539,37.630223], [55.657037,37.571271], [55.691046,37.711026], [55.803972,37.659610], [55.616448,37.452759], [55.781329,37.442781], [55.844708,37.748870], [55.723123,37.406067], [55.858585,37.484980]
	// ];
	// /**
	//  * Функция возвращает объект, содержащий данные метки.
	//  * Поле данных clusterCaption будет отображено в списке геообъектов в балуне кластера.
	//  * Поле balloonContentBody - источник данных для контента балуна.
	//  * Оба поля поддерживают HTML-разметку.
	//  * Список полей данных, которые используют стандартные макеты содержимого иконки метки
	//  * и балуна геообъектов, можно посмотреть в документации.
	//  * @see https://api.yandex.ru/maps/doc/jsapi/2.1/ref/reference/GeoObject.xml
	//  */
	// getPointData = function (index) {
	// 	return {
	// 		balloonContentBody: 'балун <strong>метки ' + index + '</strong>',
	// 		clusterCaption: 'метка <strong>' + index + '</strong>'
	// 	};
	// };
	// /**
	//  * Данные передаются вторым параметром в конструктор метки, опции - третьим.
	//  * @see https://api.yandex.ru/maps/doc/jsapi/2.1/ref/reference/Placemark.xml#constructor-summary
	//  */
	// for(var i = 0, len = points.length; i < len; i++) {
	// 	geoObjects[i] = new ymaps.Placemark(points[i], getPointData(i));
	// };

	// /**
	//  * Можно менять опции кластеризатора после создания.
	//  */
	// clusterer.options.set({
	// 	gridSize: 80,
	// 	clusterDisableClickZoom: true
	// });

	// /**
	//  * В кластеризатор можно добавить javascript-массив меток (не геоколлекцию) или одну метку.
	//  * @see https://api.yandex.ru/maps/doc/jsapi/2.1/ref/reference/Clusterer.xml#add
	//  */
	// clusterer.add(geoObjects);
	// myMap.geoObjects.add(clusterer);

	// /**
	//  * Спозиционируем карту так, чтобы на ней были видны все объекты.
	//  */
	// myMap.setBounds(clusterer.getBounds(), {
	// 	checkZoomRange: true
	// });



	// Поиск координат центра Нижнего Новгорода.
	ymaps.geocode('Электросталь', {
		/**
		 * Опции запроса
		 * @see https://api.yandex.ru/maps/doc/jsapi/2.1/ref/reference/geocode.xml
		 */
		// Сортировка результатов от центра окна карты.
		// boundedBy: myMap.getBounds(),
		// strictBounds: true,
		// Вместе с опцией boundedBy будет искать строго внутри области, указанной в boundedBy.
		// Если нужен только один результат, экономим трафик пользователей.
		results: 1
	}).then(function (res) {
			// Выбираем первый результат геокодирования.
			var firstGeoObject = res.geoObjects.get(0),
				// Координаты геообъекта.
				coords = firstGeoObject.geometry.getCoordinates(),
				// Область видимости геообъекта.
				bounds = firstGeoObject.properties.get('boundedBy');

			// Добавляем первый найденный геообъект на карту.
			myMap.geoObjects.add(firstGeoObject);
			// Масштабируем карту на область видимости геообъекта.
			myMap.setBounds(bounds, {
				// Проверяем наличие тайлов на данном масштабе.
				checkZoomRange: true
			});

			/**
			 * Все данные в виде javascript-объекта.
			 */
			console.log('Все данные геообъекта: ', firstGeoObject.properties.getAll());
			/**
			 * Метаданные запроса и ответа геокодера.
			 * @see https://api.yandex.ru/maps/doc/geocoder/desc/reference/GeocoderResponseMetaData.xml
			 */
			console.log('Метаданные ответа геокодера: ', res.metaData);
			/**
			 * Метаданные геокодера, возвращаемые для найденного объекта.
			 * @see https://api.yandex.ru/maps/doc/geocoder/desc/reference/GeocoderMetaData.xml
			 */
			console.log('Метаданные геокодера: ', firstGeoObject.properties.get('metaDataProperty.GeocoderMetaData'));
			/**
			 * Точность ответа (precision) возвращается только для домов.
			 * @see https://api.yandex.ru/maps/doc/geocoder/desc/reference/precision.xml
			 */
			console.log('precision', firstGeoObject.properties.get('metaDataProperty.GeocoderMetaData.precision'));
			/**
			 * Тип найденного объекта (kind).
			 * @see https://api.yandex.ru/maps/doc/geocoder/desc/reference/kind.xml
			 */
			console.log('Тип геообъекта: %s', firstGeoObject.properties.get('metaDataProperty.GeocoderMetaData.kind'));
			console.log('Название объекта: %s', firstGeoObject.properties.get('name'));
			console.log('Описание объекта: %s', firstGeoObject.properties.get('description'));
			console.log('Полное описание объекта: %s', firstGeoObject.properties.get('text'));

			/**
			 * Если нужно добавить по найденным геокодером координатам метку со своими стилями и контентом балуна, создаем новую метку по координатам найденной и добавляем ее на карту вместо найденной.
			 */
			/**
			 var myPlacemark = new ymaps.Placemark(coords, {
			 iconContent: 'моя метка',
			 balloonContent: 'Содержимое балуна <strong>моей метки</strong>'
			 }, {
			 preset: 'islands#violetStretchyIcon'
			 });

			 myMap.geoObjects.add(myPlacemark);
			 */
		});



}

/*

		var skin = '/themes/portal/';
		var latitude = 55.752;
		var longitude = 37.616;
		var zoom = 11;
		var map_latitude = 55.752;
		var map_longitude = 37.616;
		var path_city = '/objects/getCities/';


		// карта
		var map;
		var yMap;
		$(function() {
			yMap = new yMap();
			yMap.Init(map_latitude, map_longitude, zoom);
	//           yMap.showMarker(latitude, longitude);
			yMap.setMarker(latitude, longitude);          

			//   map = new gMap();
			//    map.Init(map_latitude, map_longitude, zoom);
//                map.setMarker(latitude, longitude);
				$(document).on("change", "#input_city_select", function(e){
					if($('#b_address').val()==''){
						$('#b_address').val($("#input_city_select option:selected").data("region")+","+$("#input_city_select option:selected").text()); 
						showOnMap(1);
					}
				});
				
				$(document).on("click", "#search_map_results a", function(e){
					e.preventDefault();
					longitude = $(this).attr("data-longitude");
					latitude = $(this).attr("data-latitude");
					if (longitude && latitude){
						yMap.Init(latitude, longitude, 17);
						yMap.setMarker(latitude, longitude); 
						$("#latitude").val(latitude);
						$("#longitude").val(longitude);
						$("#b_address").text($(this).attr("data-address"));
						$("#b_address").val($(this).attr("data-address"));
						setMetro($(this).attr("data-metro"), $(this).attr("data-metroline"));
							
					}
				});
				
					$(document).on("click", "#show_on_map_but", function(e){
						e.preventDefault();
						
						showOnMap();
					});
				
			
		});
		
		function getMetro(mlng, mlat, upd_id){
			
			var metro = new YMaps.Metro.Closest(new YMaps.GeoPoint(mlng,mlat), { results : 2 });
				
				
			// Обработчик успешного завершения
			YMaps.Events.observe(metro, metro.Events.Load, function (metro) {
				if (metro.length()) {
					
					//metro.setStyle("default#greenSmallPoint");
						//console.log(metro._objects[0].AddressDetails.Country.AdministrativeArea.Locality.Thoroughfare.Premise.PremiseName);
						// console.log(metro._objects[0]["AddressDetails"]["Country"]["AdministrativeArea"]["Locality"]["Thoroughfare"]["Premise"]["PremiseName"]);
						var metro_text = metro._objects[0]["AddressDetails"]["Country"]["AdministrativeArea"]["Locality"]["Thoroughfare"]["Premise"]["PremiseName"];
						var metro_line_text = metro._objects[0]["AddressDetails"]["Country"]["AdministrativeArea"]["Locality"]["Thoroughfare"]["ThoroughfareName"];
						
						$('#'+upd_id).attr("data-metro", metro_text);
						$('#'+upd_id).data("metro", metro_text);
						$('#'+upd_id).attr("data-metroline", metro_line_text);
						$('#'+upd_id).data("metroline", metro_line_text);
						$('#'+upd_id).text($('#'+upd_id).text()+' - ' + metro_text+ " - "+metro_line_text);
						
					//yMap.addOverlay(metro);
				} else {
					//alert("Поблизости не найдено станций метро");
				}
			});
			
			YMaps.Events.observe(metro, metro.Events.Fault, function (metro, error) {
				//alert("При выполнении запроса произошла ошибка: " + error);
			});
		}
		
		
		function updateMap()
		{
			var latitude = $('#latitude').val();
			var longitude = $('#longitude').val();
			//map.clearOverlays();
			yMap.Init(latitude, longitude, zoom);
			yMap.setMarker(latitude, longitude);
			
			
			//yMap.Init(latitude, longitude, zoom);
			//yMap.showMarker(latitude, longitude);
		}

		function showOnMap(with_click){
			address= $('#b_address').val();
			if (address!=''){
					
					var cur_city = '';
					if ($( "#input_city_select" ).val()>0){
						cur_city = $( "#input_city_select option:selected" ).text()+",";
					}
					
					var geocoder = new YMaps.Geocoder(cur_city+''+address,{results: 5});
					YMaps.Events.observe(geocoder, geocoder.Events.Load, function () {
						var tmp = $("#search_map_results").html();
								$("#search_map_results").html('<img src="/themes/portal/img/ajax-loader1.gif" height="24px;">Поиск....');
								var tmp = $("#search_map_results").html();
								tmp="<ul>";
								
						if (this.length()) {
							//alert("Найдено :" + this.length());
							//map.addOverlay(this.get(0));
							// map.panTo(this.get(0).getGeoPoint())
							
								tmp="<li>Выберите из списка:</li>";
									for(var i=0; i<this.length(); i++ ){
										var one_item = this.get(i);
										
										var iterate=i+1;
										var geopoint = one_item.getGeoPoint();
										var loc_lng = geopoint.getLng();
										var loc_lat = geopoint.getLat();
										
										tmp += "<li>"+iterate+". <a id='place-"+i+"' href='#' data-metro='' data-metroline='' data-longitude='"+loc_lng+"' data-latitude='"+loc_lat+"' data-address='"+one_item.text+"' >"+one_item.text+"</a></li>";
										getMetro(loc_lng, loc_lat, 'place-'+i);
									}
									
						} else {
							tmp="<li>Выберите из списка:</li>";
						}
							tmp+="</ul>";
								$("#search_map_results").html(tmp);
								if(with_click){
									setTimeout('$("#place-0").click();$("#b_address").val("");', 1000);
								}
					});
					
					YMaps.Events.observe(geocoder, geocoder.Events.Fault, function (geocoder, errorMessage) {
						$("#search_map_results").html("Не найдено.");
					});

			}
		}


*/