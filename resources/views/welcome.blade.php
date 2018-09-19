<br>
<br>

@extends('layouts.app')

@section('content')
<div id="wrapper">  
<br>
<br>

<script src="https://api.mqcdn.com/sdk/mapquest-js/v1.3.2/mapquest.js"></script>
<link type="text/css" rel="stylesheet" href="https://api.mqcdn.com/sdk/mapquest-js/v1.3.2/mapquest.css"/>



<!-- 
<div class="banner">
<img class="banner-image" src="images/banner1.jpg">
</div> -->
</head>
<body>

<!-- <div class="thebox">

<button class="bigbtn " type="button" onClick="document.getElementById('bookme').scrollIntoView()"><span>Book Now</span></button>
<button class="bigbtn2" type="button" onClick="document.getElementById('booklater').scrollIntoView()"><span>Book Later</span></button>
</div>
 -->


<style>



    #map {
        height: 500px;
    }
/* CSS can go in here if must */





/* -----------------------------*/
</style>




<script>
    var DEFAULT_LIMIT = 10;
    var currentLat = -37.814;
    var currentLng = 144.96332;
    var markers = [];
    var userMarker;
    function goButton() {
        loc = document.getElementById('addresstxt').value;
        if (loc.includes(',') == false) {
            loc = loc + " Victoria, Australia";
        }
        $.ajax({url: "api/geocode",
            type: "POST",
            data: { 'location': loc },
            success: function(result) {
                window.resu = result;
                resu = $.parseJSON(result);
                currentLat = resu.results[0].locations[0].latLng.lat;
                currentLng = resu.results[0].locations[0].latLng.lng;
                clearMarkers();
                clearCarList();
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
    function clearCarList() {
        carListInner = document.getElementById('carListInner');
        carListInner.innerHTML = '';
    }
    function removeUserMarker() {
        userMarker.remove();
    }
    function addUserMarker(lat, lng) {
        icon = L.icon({
            iconUrl: 'https://assets.mapquestapi.com/icon/v2/via-md-4a80f5.png'
        });
        userMarker = L.marker([lat, lng], {icon: icon}).addTo(mapcon);
    }
    function recenterMap(lat, lng) {
        mapcon.setView(new L.LatLng(lat, lng), 14);
        removeUserMarker();
        addUserMarker(lat, lng);
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
    function markerClick(e) {
        //window.location.hash = e.target.options.customId;
    }
    function addCars(cars) {
        hiddenCar = document.getElementById('hiddenCar');
        carListInner = document.getElementById('carListInner');
        for (i = 0; i < cars.length; i++) {
            car = cars[i];
            icon = L.icon({
                iconUrl: 'https://assets.mapquestapi.com/icon/v2/marker-' + (i+1) + '.png'
            });
            var carPop = new L.popup().setContent(
                car.year + " " + car.make + " " + car.model + "<br>Seats: " + car.seating + "<br>" +
                '<form style="display: inline-block;" method="post" action="book" id="carForm2">' +
                '{{ csrf_field() }}' +
                '<input type="hidden" id="carId" name="carId" value="' + car.id + '">' +
                '<input type="hidden" id="startTime" name="startTime" value="1234">' +
                '<input type="hidden" id="endTime" name="endTime" value="2345">' +
                '<input type="submit" class="btn btn-primary btn-sm" value="Book">' +
                '</form>'
            );
            markers.push(L.marker([car.lat, car.lng], {icon: icon, customId: "car" + (i + 1)}).addTo(mapcon).on('click', markerClick).bindPopup(carPop));
            carDiv = hiddenCar.cloneNode(true);
            for (j = 0; j < carDiv.childNodes.length; j++) {
                if (carDiv.childNodes[j].id == "carForm") {
                    for (k = 0; k < carDiv.childNodes[j].childNodes.length; k++) {
                        if (carDiv.childNodes[j].childNodes[k].id == "carId") {
                            carDiv.childNodes[j].childNodes[k].value = car.id;
                        }
                    }
                    //carDiv.childNodes[j].value = car.id;
                }
                if (carDiv.childNodes[j].id == "carMapId") {
                    carDiv.childNodes[j].innerHTML = (i+1);
                }
                if (carDiv.childNodes[j].id == "carModel") {
                    carDiv.childNodes[j].innerHTML = car.model;
                }
                if (carDiv.childNodes[j].id == "carMake") {
                    carDiv.childNodes[j].innerHTML = car.make;
                }
                if (carDiv.childNodes[j].id == "carYear") {
                    carDiv.childNodes[j].innerHTML = car.year;
                }
                if (carDiv.childNodes[j].id == "carSeating") {
                    carDiv.childNodes[j].innerHTML = car.seating;
                }
            }
            carDiv.id = "car" + (i + 1);
            carDiv.style.display = "block";
            carListInner.append(carDiv);
        }
    }
    
    L.Control.RecenterButton = L.Control.extend({
        onAdd: function(map) {
            var img = L.DomUtil.create('button');

            img.innerHTML = 'RECENTER';
            img.style.width = '40%';
            img.style.height = '50px';
        
            img.onclick = function () { recenterMap(window.currentLat, window.currentLng) };

            return img;
        },

        onRemove: function(map) {
            // Nothing to do here
        }
    });

    L.control.recenterbutton = function(opts) {
        return new L.Control.RecenterButton(opts);
    }

    function minit() {
        L.mapquest.key = 'KEY';
        window.mapcon = L.mapquest.map('map', {
            center: [-37.814, 144.96332],
            layers: L.mapquest.tileLayer('map'),
            zoom: 14
        });
        getCars(currentLat, currentLng, DEFAULT_LIMIT);
        addUserMarker(currentLat, currentLng);
        
        window.mapcon.addControl(L.control.recenterbutton({position: "bottomright"}));
    }
</script>
<div class="container" id="bookme">
    <div>
        <label class="col-sm-3 col-form-label">Address:</label><input type="text" class="col-md-5 form-control" id="addresstxt" value="">
        <button type="button" class= "btn col-md-1" onclick="goButton();">GO</button>
        <br>
        <br>
        <div id="map"></div>
    </div>
    <br><br><br>

 <div class="bookingbox">   <!-- Temporary box -->
<strong>[ Temporary box ]</strong>

    <div id="carListOutter">
        <div id="hiddenCar" style="display: none;">
            <span id="carMapId"></span>
            <span id="carMake"></span>
            <span id="carModel"></span>
            <span id="carYear"></span><br>
            Seats: <span id="carSeating"></span>
            <form method="post" action="book" id="carForm">
                {{ csrf_field() }}
                <input type="hidden" id="carId" name="carId" value="">
                <input type="hidden" id="startTime" name="startTime" value="1234">
                <input type="hidden" id="endTime" name="endTime" value="2345">
                <input type="submit" value="Book">
            </form>
        </div>
        <div id="carListInner">
            
        </div>
    </div>
</div>

</div>

<script>
    minit();
</script>  

<div class="container">
    <div>
		<label class="col-sm-3 col-form-label">Address:</label><input type="text" class="col-md-5 form-control" id="addresstxt" value="">
		<button type="button" class= "btn col-md-1" onclick="goButton();">GO</button>
		<br>
		<br>
		<div id="map"></div>
    </div>
    <br><br><br>
    <div id="carListOutter">
		<div id="hiddenCar" style="display: none;">
			<span id="carMapId"></span>
			<span id="carMake"></span>
			<span id="carModel"></span>
			<span id="carYear"></span><br>
			Seats: <span id="carSeating"></span>
			<form method="post" action="book" id="carForm">
				<input type="hidden" name="_token" value="kwMRyWiYVFUtyF99udLbZFLTbP611K0lFk5lFb83">
				<input type="hidden" id="carId" name="carId" value="">
				<input type="hidden" id="startTime" name="startTime" value="1234">
				<input type="hidden" id="endTime" name="endTime" value="2345">
				<input type="submit" value="Book">
			</form>
		</div>
		<div id="carListInner">
			
		</div>
		<div class="carInfo">
			<p>Cars</p>
			<ul style="text-align: left;">
				<li>5 passengers</li>
				<li>2 large suitcaases,2 small suitcases</li>
				<li>automatic transmission</li>
				<li>air conditioning</li>
				<li>15 km/liters</li>
			</ul>
			<button class="carBook" type="submit">book now</button>
		</div>
		<div class="carInfo2">
			<p>Cars</p>
			<ul style="text-align: left;">
				<li>5 passengers</li>
				<li>2 large suitcaases,2 small suitcases</li>
				<li>automatic transmission</li>
				<li>air conditioning</li>
				<li>15 km/liters</li>
			</ul>
			<button class="carBook2" type="submit">book now</button>
		</div>
    </div>
</div>

</div> <!-- wrapper div-->
@endsection
