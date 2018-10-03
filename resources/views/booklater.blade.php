<br>
<br>

@extends('layouts.app')

@section('content')
<!-- Fix layouts -->
<div class="bookingbox">

<script>
  $( function() {
    $( "#datepicker" ).datepicker();
  } );
  	var DEFAULT_LIMIT = 10;
	var currentLat = -37.814;
	var currentLng = 144.96332;
  function getCars(startTime, endTime) {
        $.ajax({url: "api/carssorted",
            type: "POST",
            data: { 'lng': currentLng, 'lat': currentLat, 'limit': DEFAULT_LIMIT, 'startTime': startTime, 'endTime': endTime },
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
        hiddenCar = document.getElementById('hiddenCar');
        carListInner = document.getElementById('carListInner');
        for (i = 0; i < cars.length; i++) {
            car = cars[i];
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
                if (carDiv.childNodes[j].id == "carCost") {
					carpph = ((Number(document.getElementById('hours').value) / 60) / 60) * car.pph;
					carpph = carpph.toFixed(2);
                    carDiv.childNodes[j].innerHTML = "$" + carpph;
                }
            }
            carDiv.id = "car" + (i + 1);
            carDiv.style.display = "block";
            carListInner.append(carDiv);
        }
    }
  function clearCarList() {
		carListInner = document.getElementById('carListInner');
		carListInner.innerHTML = '';
	}
  function showCars() {
	  dp = $( "#datepicker").datepicker('getDate');
	  date = dp.getTime() / 1000;
	  startTime = Number(document.getElementById('time').value);
	  startTime = startTime + date;
	  endTime = startTime + Number(document.getElementById('hours').value);
	  clearCarList();
	  getCars(startTime, endTime);
  }
</script>

<div id="wrapper">

<div class="container">
	<div class="book-form__text">
		Choose your area:
        <select name="location">
			<option disabled>Location</option>
			<option value="Melbourne CBD">Melbourne CBD</option>
		</select>
	</div>
	
	<div class="book-form__text">Car type:
		<select name="type">
			<option disabled>type</option>
			<option value="coupe">coupe</option>
			<option value="sedan">sedan</option>
			<option value="SUV">SUV</option>
		</select>
	</div><br>
	
	<div class="book-form__text">
		Date and Time<br>
		<input type="text" id="datepicker" size="30">
		<select id="time">
			<option value="28800">08:00 AM</option>
			<option value="32400">09:00 AM</option>
			<option value="36000">10:00 AM</option>
			<option value="39600">11:00 AM</option>
			<option value="43200">12:00 PM</option>
			<option value="46800">1:00 PM</option>
			<option value="50400">2:00 PM</option>
			<option value="54000">3:00 PM</option>
			<option value="57600">4:00 PM</option>
			<option value="61200">5:00 PM</option>
			<option value="64800">6:00 PM</option>
			<option value="68400">7:00 PM</option>
			<option value="72000">8:00 PM</option>
		</select>
		<select id="hours">
			<option value="3600">1 hour</option>
			<option value="7200">2 hours</option>
		</select>
	</div>
    <div class="book-form__text">
		<button type="button" class="btn btn-primary" onclick="showCars()">Show available cars</button>
	</div>
	
	    <div id="carListOutter">
		<div id="hiddenCar" class="container justify-content-center" style="display: none;">
			<span id="carMapId"></span>
			<span id="carMake"></span>
			<span id="carModel"></span>
			<span id="carYear"></span><br>
			Seats: <span id="carSeating"></span><br>
			Cost: <span id="carCost"></span><br>
			<form method="post" action="confirm" id="carForm" style="display:inline-block">
				{{ csrf_field() }}
				<input type="hidden" id="carId" name="carId" value="">
				<input type="hidden" id="startTime" name="startTime" value="1234">
				<input type="hidden" id="endTime" name="endTime" value="2345">
				<input type="submit" class="btn btn-primary" value="Book">
			</form>
		</div>
		<div id="carListInner">
			
		</div>
		</div>
</div>
</div>  <!--wrapper div -->
</div>

@endsection

