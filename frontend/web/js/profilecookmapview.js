;(function(){
$(document).ready(function(){

	ymaps.ready(init);

	// var existMapRegion = $("#map_region").length;
	// var existAddress = $("#map_address").length;

	// if (existMapRegion) { ymaps.ready(init); }

	var mapRegion;
	var myPlacemark;
	var geoObjects = [];


	var defaultLatitude = 55.73;
	var defaultLongitude = 37.62;
	var defaultZoom = 10;
	var defaultAddressDescription = {
		balloonContentHeader: 'Москва',
		balloonContent: 'Россия, г. Москва'
		// balloonContentFooter: 'balloonContentFooter'
	};

	var region = $("#js_profilecookmap_inputregion").val();

	function init() {

		mapRegion = new ymaps.Map("map_region", {
			center: [defaultLatitude,defaultLongitude],
			zoom: defaultZoom,
			controls: ['geolocationControl','fullscreenControl','zoomControl']
		});

		if (region) {

			clusterer = new ymaps.Clusterer({
				// preset: 'islands#invertedVioletClusterIcons',
				groupByCoordinates: false,
				clusterDisableClickZoom: true,
				clusterHideIconOnBalloonOpen: false,
				geoObjectHideIconOnBalloonOpen: false
			});
			clusterer.options.set({
				gridSize: 80,
				clusterDisableClickZoom: true
			});

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

			// geoObjects.push(myPolygon);
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
			// console.log(geoObjects);


			// clusterer.add(geoObjects);
			// mapRegion.geoObjects.add(clusterer);
			// mapRegion.setBounds(clusterer.getBounds(), {
			// 	checkZoomRange: true
			// });
		}

// .panTo(coord, {
// 			delay: 1000
// 		});

		// Кластеризация




	}

});
})();