var Cartographer = (function() {
	var options,
		map;

	function _ready(callback) {
		window.addEventListener('load', callback);
	};

	function _find(selector) {
		return document.querySelector(selector);
	};

	function _renderMap() {
		var url = 'https://cartodb-basemaps-{s}.global.ssl.fastly.net/light_all/{z}/{x}/{y}.png';

		_ready(function() {
			map = L.map('fields-cartographer-map', {
				center: [options.lat, options.lng],
				zoom: options.zoom
			});

			L.Icon.Default.imagePath = '/assets/img/leaflet/';

			L.tileLayer(url).addTo(map);
		});
	};

	function _process() {
		if (this.status === 200) {
			var result = JSON.parse(this.responseText).results[0],
				obj = {
					lat: result.geometry.location.lat,
					lng: result.geometry.location.lng,
					address: result.formatted_address,
					parts: result.address_components
				};

			// TODO: Fill in these with some sort of loop based on the keys you save on the object above
			_find('input[name*="address-input"]').value = obj.address;
			_find('input[name*="lat-input"]').value = obj.lat;
			_find('input[name*="lng-input"]').value = obj.lng;

			_find('#fields-lat').value = obj.lat;
			_find('#fields-lng').value = obj.lng;
			_find('#fields-address').value = obj.address;
			_find('#fields-parts').value = JSON.stringify(obj.parts);

			addMarker([obj.lat, obj.lng]);
		}
	};

	function _sendRequest() {
		var x = new XMLHttpRequest(),
			baseUrl = 'https://maps.googleapis.com/maps/api/geocode/json',
			data = {
				address: _find('input[name*="address-input"]').value,
				key: options.apiKey
			};

		// This only works in IE10+; just use onreadystatechange
		x.addEventListener('load', _process);
		x.open('GET', baseUrl + '?address=' + data.address + '&key=' + data.key);
		x.send();
	};

	function _bind() {
		var input = _find('.cartographer__submit');

		input.addEventListener('click', _sendRequest);
	};

	function addMarker(coords) {
		L.marker(coords).addTo(map);

		map.setView(coords);
	};

	function init(settings, value) {
		options = JSON.parse(settings),
		currentValues = JSON.parse(value);

		_renderMap();

		if (currentValues.hasOwnProperty('lat') && currentValues.lat) {
			_ready(function() {
				addMarker([currentValues.lat, currentValues.lng]);
			});
		}

		_bind();
	};

	return {
		init: init,
		addMarker: addMarker
	}
})();