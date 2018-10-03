<br>
<br>

@extends('layouts.app')
@section('content')
@if(Auth::check() && Auth::user()->type == "suspended")
<div id="wrapper">
<div class="container">
	<div class="bookingbox">
		Sorry, your account has been suspended from making bookings.
	</div>
</div>
</div>
@else
<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.3.1/css/all.css" integrity="sha384-mzrmE5qonljUremFsqc01SB46JvROS7bZs3IO2EmfFsd15uHvIt+Y8vEf7N7fWAU" crossorigin="anonymous">
<div id="wrapper">  

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
    @media screen and (-webkit-min-device-pixel-ratio:0) {
		.form-control {
			font-size: 16px;
		}
	}
	@media (min-width: 768px) {
		.form-control {
			font-size: 14px;
		}
	}
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
        window.startTime = Math.floor(Date.now() / 1000);
        addSeconds = Number(document.getElementById('timeSelector').value);
        window.endTime = startTime + addSeconds;
        $.ajax({url: "api/carssorted",
            type: "POST",
            data: { 'lng': lng, 'lat': lat, 'limit': limit, 'startTime': startTime, 'endTime': endTime },
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
            carpph = ((Number(document.getElementById('timeSelector').value) / 60) / 60) * car.pph;
            carpph = carpph.toFixed(2);
            var carPop = new L.popup().setContent(
                car.year + " " + car.make + " " + car.model + "<br>Seats: " + car.seating + "<br>" +
                "Cost: $" + carpph + "<br>" +
                '<form style="display: inline-block;" method="post" action="confirm" id="carForm2">' +
                '{{ csrf_field() }}' +
                '<input type="hidden" id="carId" name="carId" value="' + car.id + '">' +
                '<input type="hidden" id="startTime" name="startTime" value="' + startTime + '">' +
                '<input type="hidden" id="endTime" name="endTime" value="' + endTime + '">' +
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
                        if (carDiv.childNodes[j].childNodes[k].id == "startTime") {
                            carDiv.childNodes[j].childNodes[k].value = startTime;
                        }
                        if (carDiv.childNodes[j].childNodes[k].id == "endTime") {
                            carDiv.childNodes[j].childNodes[k].value = endTime;
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
            //img.style.width = '40%';
            //img.style.height = '50px';
            img.classList.add("btn");
			img.classList.add("btn-primary");
        
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
    
    L.Control.Addr = L.Control.extend({
        onAdd: function(map) {
            var img = L.DomUtil.create('div');
            var addrbar = document.getElementById("addrbar");
            img.innerHTML = addrbar.innerHTML;
        
            img.onclick = function () { recenterMap(window.currentLat, window.currentLng) };
            L.DomEvent.disableClickPropagation(img)

            return img;
        },

        onRemove: function(map) {
            // Nothing to do here
        }
    });

    L.control.addr = function(opts) {
        return new L.Control.Addr(opts);
    }
    
    function changeTime() {
        clearMarkers();
        clearCarList();
        getCars(currentLat, currentLng, DEFAULT_LIMIT);
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
        window.mapcon.zoomControl.setPosition("bottomright");
        window.mapcon.addControl(L.control.addr({position: "topleft"}));
    }
    
    function search(e) {
		if (e.keyCode == '13') {
			goButton();
		}
	}
</script>
<div class="container" id="bookme">
    <div>
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
            <form method="post" action="confirm" id="carForm">
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
<div id="addrbar" style="display: none;">
	<div class="container">
		<div class="input-group mb-2">
			<input type="text" class="form-control" id="addresstxt" onkeydown="search(event);" value="" placeholder="Address">
			<div class="input-group-append">
				<button type="button" class="btn btn-primary" onclick="goButton();">
					<i class="fas fa-search-location"></i>
				</button>
			</div>
		</div>
		<select id="timeSelector" class="custom-select form-control col-12" onchange="changeTime(this.value);">
			<option value="120">2 minutes</option>
			<option value="1800">30 minutes</option>
			<option value="3600">1 hour</option>
			<option value="7200">2 hours</option>
		</select>
    </div>
</div>
<script>
    minit();
</script>  

</div> <!-- wrapper div-->
@endif
@endsection
