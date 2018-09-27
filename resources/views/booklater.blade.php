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

<br><br>
<div class="bookingbox">
	<table class="table table-striped">
		  <tr>
		    <th>Choose your Area:</th>
		    <td>	
		    		<select name="location">
					<option disabled>Location</option>
					<option value="Melbourne CBD">Melbourne CBD</option>
					</select>
			</td>
		  </tr>

		  <tr>
		    <th>Car Type:</th>
		    <td>
		    		<select name="type">
					<option disabled>type</option>
					<option value="coupe">Coupe</option>
					<option value="sedan">Sedan</option>
					<option value="SUV">SUV</option>
					</select>
			</td>
		  </tr>

		  <tr>
		    <th>Choose a date:</th>
		    <td> <input placeholder="Select a date"type="text" id="datepicker" size="15">  </td>
		  </tr>

		  <tr>
		    <th>Choose a time:</th>
		    <td>
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
		    </td>
		  </tr>

		  <tr>
		    <th>Number of Hours</th>
		    <td>
		    	<select id="hours">
				<option value="3600">1 hour</option>
				<option value="7200">2 hours</option>
				</select>
			</td>
		  </tr>

		  <tr>
		    <th></th>
		    <td>
				<button type="button" class="btn btn-primary" onclick="showCars()">Show available cars</button>
			</td>
		  </tr>
	</table>
</div>

	<table class="table table-striped">

	    <div "id="carListOutter">
		<div id="hiddenCar" style="display: none;">
			ID: <span id="carMapId"></span><br>
			Make: <span id="carMake"></span><br>
			Model: <span id="carModel"></span><br>
			Year: <span id="carYear"></span><br>
			Seats: <span id="carSeating"></span><br>
			<form method="post" action="book" id="carForm">
				{{ csrf_field() }}
				<input type="hidden" id="carId" name="carId" value="">
				<input type="hidden" id="startTime" name="startTime" value="1234">
				<input type="hidden" id="endTime" name="endTime" value="2345">
				<input class="btn btn-primary" type="submit" value="Book">
			</form>
			<br><br>
		</div>
		<div id="carListInner">
			
		</div>
		</div>

	</table>
</div>
</div>  <!--wrapper div -->
</div>

@endsection

