<br>
<br>

@extends('layouts.app')

@section('content')
<script src="https://api.mqcdn.com/sdk/mapquest-js/v1.3.2/mapquest.js"></script>
<link type="text/css" rel="stylesheet" href="https://api.mqcdn.com/sdk/mapquest-js/v1.3.2/mapquest.css"/>
<style>
	#map {
		height: 200px;
	}
</style>
<script>
	var DEFAULT_LIMIT = 10;
	var currentLat = -37.814;
	var currentLng = 144.96332;
	var markers = [];
	function goButton() {
		loc = document.getElementById('addresstxt').value;
		$.ajax({url: "api/geocode",
			type: "POST",
			data: { 'location': loc },
			success: function(result) {
				window.resu = result;
				resu = $.parseJSON(result);
				currentLat = resu.results[0].locations[0].latLng.lat;
				currentLng = resu.results[0].locations[0].latLng.lng;
				clearMarkers();
				recenterMap(resu.results[0].locations[0].latLng.lat, resu.results[0].locations[0].latLng.lng);
				getCars(currentLat, currentLng, DEFAULT_LIMIT);
			}, error: function(xhr) {
				console.log(xhr.status);
				console.log(xhr.statusText);
				}
		});
	}
	function clearMarkers() {
		for (i = 0; i < markers.length; i++) {
			markers[i].remove();
		}
	}
	function recenterMap(lat, lng) {
		mapcon.setView(new L.LatLng(lat, lng), 14);
	}
	function getCars(lat, lng, limit) {
		$.ajax({url: "api/carssorted",
			type: "POST",
			data: { 'lng': lng, 'lat': lat, 'limit': limit },
			success: function(result) {
				window.cresu = result;
				addCars(result);
			}, error: function(xhr) {
				console.log(xhr.status);
				console.log(xhr.statusText);
				}
		});
	}
	function addCars(cars) {
		for (i = 0; i < cars.length; i++) {
			car = cars[i];
			markers.push(L.marker([car.lat, car.lng]).addTo(mapcon));
		}
	}
	function minit() {
		L.mapquest.key = 'KEY';
		window.mapcon = L.mapquest.map('map', {
			center: [-37.814, 144.96332],
			layers: L.mapquest.tileLayer('map'),
			zoom: 14
		});
		getCars(currentLat, currentLng, DEFAULT_LIMIT);
	}
</script>
<div class="container">
    <div>
		Address: <input type="text" id="addresstxt" value="">
		<button type="button" onclick="goButton();">GO</button>
		<div id="map"></div>
    </div>
</div>
<script>
	minit();
</script>
@endsection
