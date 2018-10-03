<br>
<br>

@extends('layouts.app')

@section('content')

<div class="container">
    <div class="row justify-content-center">
		<div class="col-md-8">
			<div class="card">
                <div class="card-header">Confirm Booking</div>
					<div class="card-body">
						{{ $car->year }} {{ $car->model }} {{ $car->make }}<br>
						Start Time: {{ $startDate }}<br>
						End Time: {{ $endDate }}<br>
						<br>
						<b>COST: ${{ $cost }}</b><br>
						<br>
						<form method="post" action="book" style="display: inline-block">
							{{ csrf_field() }}
							<input type="hidden" id="carId" name="carId" value="{{ $car->id }}">
							<input type="hidden" id="startTime" name="startTime" value="{{ $startTime }}">
							<input type="hidden" id="endTime" name="endTime" value="{{ $endTime }}">
							<input type="submit" class="btn btn-primary" value="CONFIRM AND PAY NOW">
						</form>
						<br>
						<button class="btn btn-primary" onclick="window.location='/';">CANCEL</button>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>
@endsection

