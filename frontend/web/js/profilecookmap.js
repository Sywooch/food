;(function(){
$(document).ready(function(){

	ymaps.ready(init);

	// var existMapRegion = $("#map_region").length;
	// var existAddress = $("#map_address").length;

	// if (existMapRegion) { ymaps.ready(init); }

	var myMap;
	var mapRegion;
	var myPlacemark;

	var defaultLatitude = 55.73;
	var defaultLongitude = 37.62;
	var defaultZoom = 10;
	var defaultAddressDescription = {
		balloonContentHeader: 'Москва',
		balloonContent: 'Россия, г. Москва'
		// balloonContentFooter: 'balloonContentFooter'
	};

	var latitude = $('#js_profilecookmap_inputlatitude').val();
	var longitude = $('#js_profilecookmap_inputlongitude').val();
	var address = $('#js_profilecookmap_inputaddress').val();
	var region = $("#js_profilecookmap_inputregion").val();




	function init() {

		// Регион
		mapRegion = new ymaps.Map("map_region", {
			center: [defaultLatitude,defaultLongitude],
			zoom: defaultZoom,
			controls: ['geolocationControl','fullscreenControl','zoomControl']
		});


		// Создаем многоугольник
		if (region) {
			var regionArray = [];
			var arrr = region.split(',');
			var i = 0;
			var arrrLen = arrr.length;
			arrr.forEach(function(item) {
				if ( ((i%2)==0) && ((i+1)!==arrrLen) ) {
			    	regionArray.push([parseFloat(item),parseFloat(arrr[i+1])]);
				}
			    i++;
			});
			myPolygon = new ymaps.Polygon([
				regionArray
			]);
			mapRegion.geoObjects.add(myPolygon);

			var pixelBounds = myPolygon.geometry.getPixelGeometry().getBounds();
			var pixelCenter = [pixelBounds[0][0] + (pixelBounds[1][0] - pixelBounds[0][0]) / 2, (pixelBounds[1][1] - pixelBounds[0][1]) / 2 + pixelBounds[0][1]];
			var geoCenter = mapRegion.options.get('projection').fromGlobalPixels(pixelCenter, mapRegion.getZoom());

			mapRegion.panTo(geoCenter, {
				delay: 1000
			});

		}


		editRegion = new ymaps.control.Button("Рисовать регион");
		editRegion.events.add(
				'select',
				function () {
					polygon = new ymaps.GeoObject({
						geometry: {
							type: "Polygon",
							coordinates: []
						}
					});
					mapRegion.geoObjects.removeAll();
					mapRegion.geoObjects.add(polygon);
					polygon.editor.startDrawing();

					// Слушаем клик на карте.
					// mapRegion.events.add('click', function (e) {
					// 	var coords = e.get('coords');
					// 	$("#js_profilecookmap_inputregion").val(coords);
					// });

			    }
		  	)
			.add(
			    'deselect',
			    function () {
					polygon.editor.stopDrawing();
					$("#js_profilecookmap_inputregion").val(polygon.geometry.getCoordinates());
					// mapRegion.events.remove('click');
			    }
			);
	    mapRegion.controls.add(editRegion, {float: 'right'});


// .panTo(coord, {
// 			delay: 1000
// 		});

		// Кластеризация
		clusterer = new ymaps.Clusterer({
			// preset: 'islands#invertedVioletClusterIcons',
			groupByCoordinates: false,
			clusterDisableClickZoom: true,
			clusterHideIconOnBalloonOpen: false,
			geoObjectHideIconOnBalloonOpen: false
		});

		// geoObjects = [];
		// points = [
		// 	[55.831903,37.411961], [55.763338,37.565466], [55.763338,37.565466], [55.744522,37.616378], [55.780898,37.642889], [55.793559,37.435983], [55.800584,37.675638], [55.716733,37.589988], [55.775724,37.560840], [55.822144,37.433781], [55.874170,37.669838], [55.716770,37.482338], [55.780850,37.750210], [55.810906,37.654142], [55.865386,37.713329], [55.847121,37.525797], [55.778655,37.710743], [55.623415,37.717934], [55.863193,37.737000], [55.866770,37.760113], [55.698261,37.730838], [55.633800,37.564769], [55.639996,37.539400], [55.690230,37.405853], [55.775970,37.512900], [55.775777,37.442180], [55.811814,37.440448], [55.751841,37.404853], [55.627303,37.728976], [55.816515,37.597163], [55.664352,37.689397], [55.679195,37.600961], [55.673873,37.658425], [55.681006,37.605126], [55.876327,37.431744], [55.843363,37.778445], [55.875445,37.549348], [55.662903,37.702087], [55.746099,37.434113], [55.838660,37.712326], [55.774838,37.415725], [55.871539,37.630223], [55.657037,37.571271], [55.691046,37.711026], [55.803972,37.659610], [55.616448,37.452759], [55.781329,37.442781], [55.844708,37.748870], [55.723123,37.406067], [55.858585,37.484980]
		// ];
		// getPointData = function (index) {
		// 	return {
		// 		balloonContentBody: 'балун <strong>метки ' + index + '</strong>',
		// 		clusterCaption: 'метка <strong>' + index + '</strong>'
		// 	};
		// };
		// for(var i = 0, len = points.length; i < len; i++) {
		// 	geoObjects[i] = new ymaps.Placemark(points[i], getPointData(i));
		// };

		clusterer.options.set({
			gridSize: 80,
			clusterDisableClickZoom: true
		});

		// clusterer.add(geoObjects);
		// myMap.geoObjects.add(clusterer);
		// myMap.setBounds(clusterer.getBounds(), {
		// 	checkZoomRange: true
		// });




























		var myCollection = new ymaps.GeoObjectCollection();

		if ( (latitude !== '') && (longitude !== '') ) {
			var addressLatitude = latitude;
			var addressLongitude = longitude;
			var addressDescription = {
				// balloonContentHeader: 'db.country',
				balloonContent: address
				// balloonContentFooter: 'db.region'
			};
			createMap({
				center: [latitude,longitude],
				zoom: defaultZoom,
				controls: ['geolocationControl','fullscreenControl','zoomControl']
			});
		} else {
			// ymaps.geolocation.get().then(function (res) {
			// 	var bounds = res.geoObjects.get(0).properties.get('boundedBy');
			// 	var addressLatitude = bounds[1][0];
			// 	var addressLongitude = bounds[1][1];
			// 	console.log(bounds);
			// 	console.log('getloc');
			// 	var addressDescription = {
			// 		balloonContentHeader: ymaps.geolocation.country,
			// 		balloonContent: ymaps.geolocation.city,
			// 		balloonContentFooter: ymaps.geolocation.region
			// 	};
			// 	var mapContainer = $('#map_canvas');
			// 	var mapState = ymaps.util.bounds.getCenterAndZoom(
			// 		bounds,
			// 		[mapContainer.width(), mapContainer.height()]
			// 	);
			// 	createMap(mapState);
			// }, function (e) {
				var addressLatitude = defaultLatitude;
				var addressLongitude = defaultLongitude;
				var addressDescription = defaultAddressDescription
				createMap({
					center: [defaultLatitude,defaultLongitude],
					zoom: defaultZoom,
					controls: ['geolocationControl','fullscreenControl','zoomControl']
				});
				// myMap = new ymaps.Map("map_canvas", {
				// 	center: [defaultLatitude,defaultLongitude],
				// 	zoom: defaultZoom,
				// 	controls: []
				// });
			// });
		}

		function createMap (state) {
			myMap = new ymaps.Map("map_canvas", state);
		}


		// Слушаем клик на карте.
		myMap.events.add('click', function (e) {
			var coords = e.get('coords');

			// Если метка уже создана – просто передвигаем ее.
			if (myPlacemark) {
				myPlacemark.geometry.setCoordinates(coords);
			}
			// Если нет – создаем.
			else {
				myPlacemark = createPlacemark(coords);
				myMap.geoObjects.add(myPlacemark);
			}
			getAddress(coords);
		});

		// Создаем метку
		myPlacemark = new ymaps.Placemark(
			[addressLatitude, addressLongitude], 
			addressDescription, 
			{
				preset: 'islands#icon',
				iconColor: '#EE5E29',
				draggable: true
			}
		);
		myPlacemark.events.add('dragend', function () {
			getAddress(myPlacemark.geometry.getCoordinates());
		});


		// Определяем адрес по координатам (обратное геокодирование).
		function getAddress(coords) {
			myPlacemark.properties.set('iconCaption', 'поиск...');
			ymaps.geocode(coords).then(function (res) {
				var firstGeoObject = res.geoObjects.get(0);
				var iconCaption = firstGeoObject.properties.get('name');
				var balloonContent = firstGeoObject.properties.get('text');
				$("#js_profilecookmap_inputaddress").val(balloonContent);
				$( "#js_profilecookmap_inputlatitude" ).val( coords[0] );
				$( "#js_profilecookmap_inputlongitude" ).val( coords[1] );
				myPlacemark.properties
					.set({
						balloonContentHeader: firstGeoObject.properties.get('name'),
						balloonContent: firstGeoObject.properties.get('text')
					});
			});
		}

		// Добавляем метку на карту
		myMap.geoObjects.add(myPlacemark);
	}


	function setMarkCoords(coord,description) {
		myMap.geoObjects.removeAll();
		myMap.geoObjects.add(
			new ymaps.Placemark(
				coord,
				description
			)
		);
		$( "#js_profilecookmap_inputlatitude" ).val( coord[0] );
		$( "#js_profilecookmap_inputlongitude" ).val( coord[1] );
		myMap.panTo(coord, {
			delay: 1000
		});
	}

	// var timeoutAddressSearch
	// $("#js_profilecookmap_inputaddress").keyup(function() {
	// 	console.log('search');
	// 	clearTimeout(timeoutAddressSearch);
	// 	if (
	// 		event.keyCode == 37 ||
	// 		// event.keyCode == 38 ||
	// 		event.keyCode == 39 
	// 		// event.keyCode == 40
	// 	)
	// 	{
	// 		return false;
	// 	}

	// 	if (
	// 		event.keyCode == 13
	// 	)
	// 	{
	// 		// $('#js_searchmain_searchquery').autocomplete("disable");
	// 		return false;
	// 	}

	// 	var val = $(event.target).val();
	// 	val.trim();
	// 	if ( (val != '') && (val.length > 2) )  {
	// 		console.log('search query = ' + val);
	// 		timeoutAddressSearch = setTimeout(function() {
	// 			console.log('run search');
	// 			// $('#js_searchmain_searchquery').autocomplete("disable");
	// 			$('#js_searchmain_searchquery').autocomplete("enable");
	// 			ymaps.geocode(val, {
	// 				results: 10
	// 			}).then(function (res) {
	// 				var coordinates = [];
	// 				var objects = [];
	// 				for (var i = 0; i < 10; i++) {
	// 					if (res.geoObjects.get(i)) {
	// 						var coord = res.geoObjects.get(i).geometry.getCoordinates();
	// 						var address = res.geoObjects.get(i).properties.get('text');
	// 						if (i==0) {
	// 							myMap.geoObjects.removeAll();
	// 							setMarkCoords(coord, address);
	// 						}
	// 						coordinates[i] = res.geoObjects.get(i).geometry.getCoordinates();
	// 						objects[i] = {
	// 							value : i,
	// 							label : address,
	// 							coord : coord
	// 						};
	// 					} else {
	// 						console.log(objects);
	// 						break;
	// 					}
	// 				}
	// 				console.log('length objects = ' + objects.length);
	// 				$('#js_profilecookmap_inputaddress').autocomplete({
	// 					minLength: 1,
	// 					source: objects,
	// 					focus: function( event, ui ) {
	// 						$( "#js_profilecookmap_inputaddress" ).val( ui.item.label );
	// 						return false;
	// 					},
	// 					select: function( event, ui ) {
	// 						if ( ui.item ) {
	// 							setMarkCoords(ui.item.coord, ui.item.label);
	// 							$( "#js_profilecookmap_inputaddress" ).val( ui.item.label );
	// 						}
	// 						return false;
	// 					}
	// 				});
	// 			});

	// 		}, 1000);
	// 	}
	// }).keydown(function() {
	// 	clearTimeout(timeoutAddressSearch);
	// });
	var returnedObjects;
	var timeoutAddressSearch;

	$("#js_profilecookmap_inputaddress").keyup(function() {
		if (timeoutAddressSearch !== undefined) {
			clearTimeout(timeoutAddressSearch);
		}
		if (
			event.keyCode == 37 ||
			// event.keyCode == 38 ||
			event.keyCode == 39 
			// event.keyCode == 40
		)
		{
			return false;
		}
		if (
			event.keyCode == 13
		)
		{
			return false;
		}
		var val = $(event.target).val();
		val.trim();
		console.log(val);
		if ( (val != '') && (val.length > 2) )  {
			timeoutAddressSearch = setTimeout(function() {
				ymaps.geocode(val, {
					results: 10
				}).then(function (res) {
					var coordinates = [];
					var objects = [];
					for (var i = 0; i < 10; i++)
					{
						if (res.geoObjects.get(i)) {
							var coord = res.geoObjects.get(i).geometry.getCoordinates();
							var address = res.geoObjects.get(i).properties.get('text');
							if (i==0) {
								myMap.geoObjects.removeAll();
								setMarkCoords(coord, address);
							}
							coordinates[i] = res.geoObjects.get(i).geometry.getCoordinates();
							objects[i] = {
								value : i,
								label : address,
								coord : coord
							};
						} else {
							console.log('length objects = ' + objects.length);
							returnedObjects = objects;
							// returnedObjects = $.map(data, function(i, item) {
							// 	return {
							// 		value : i,
							// 		label : item.address,
							// 		coord : item.coord
							// 	}
							// });
							break;
						}
					}
				});
			}, 1000);
		}
	}).keydown(function() {
		if (timeoutAddressSearch !== undefined) {
			clearTimeout(timeoutAddressSearch);
		}
	});


	$('#js_profilecookmap_inputaddress').autocomplete({
		minLength: 1,
		delay: 1100,
		source: function(request, response) {
			console.log('returnedObjects:');
			console.log(returnedObjects);
			response(returnedObjects);
			return false;
		},
		focus: function( event, ui ) {
			$( "#js_profilecookmap_inputaddress" ).val( ui.item.label );
			return false;
		},
		select: function( event, ui ) {
			if ( ui.item ) {
				setMarkCoords(ui.item.coord, ui.item.label);
				$( "#js_profilecookmap_inputaddress" ).val( ui.item.label );
			}
			return false;
		}
	});






});
})();