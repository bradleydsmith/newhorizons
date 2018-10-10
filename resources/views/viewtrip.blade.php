<br>
<br>

@extends('layouts.app')

@section('content')
<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.3.1/css/all.css" integrity="sha384-mzrmE5qonljUremFsqc01SB46JvROS7bZs3IO2EmfFsd15uHvIt+Y8vEf7N7fWAU" crossorigin="anonymous">
<link rel="stylesheet" href="https://unpkg.com/leaflet@1.3.4/dist/leaflet.css"
   integrity="sha512-puBpdR0798OZvTTbP4A8Ix/l+A4dHDD0DGqYW6RQ+9jxkRFclaxxQb/SJAWZfWAkuyeQUytO7+7N4QKrDh+drA=="
   crossorigin=""/>
    <script src="https://unpkg.com/leaflet@1.3.4/dist/leaflet.js"
   integrity="sha512-nMMmRyTVoLYqjP9hrbed9S+FzjZHW5gY1TWCHA5ckwXZBadntCNs8kEqAWdrb9O7rxbCaA4lKTIWjDXZxflOcA=="
   crossorigin=""></script>
   <link rel="stylesheet" href="css/leaflet-beautify-marker-icon.css"/>
   <script src="js/leaflet-beautify-marker-icon.js"></script>
   <script src="js/jquery.documentsize.js"></script>
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Dashboard</div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif
                    @if(!empty($tripJson))
						<div id="map" style="height:70%"></div>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>
<script>
	window.trip = {!! $tripJson !!};
	console.log(trip);
	window.map = L.map('map');
	L.tileLayer('https://cartodb-basemaps-{s}.global.ssl.fastly.net/light_all/{z}/{x}/{y}.png').addTo(map);
	map.attributionControl.remove();
	map.zoomControl.remove();
	map.dragging.disable();
    map.touchZoom.disable();
    map.doubleClickZoom.disable();
    map.scrollWheelZoom.disable();
	L.polyline(trip).addTo(map);
	startLat = trip[0][0];
	startLng = trip[0][1];
	endLat = trip[trip.length-1][0];
	endLng = trip[trip.length-1][1];
	var options = {
          icon: 'car',
          iconShape: 'marker',
          borderColor: '#b3334f',
          textColor: '#b3334f'
    };
    L.marker([startLat, startLng], {
          icon: L.BeautifyIcon.icon(options),
          interactive: false
        }).addTo(map);
    var options = {
          icon: 'car',
          iconShape: 'marker',
          borderColor: 'green',
          textColor: 'green'
    };
    L.marker([endLat, endLng], {
          icon: L.BeautifyIcon.icon(options),
          interactive: false
        }).addTo(map);
	map.fitBounds(trip);
	
	//window.addEventListener("resize", function(){resize()}, true)
	
	function resize() {
		map.invalidateSize();
		map.fitBounds(trip);
	}
</script>
@endsection
