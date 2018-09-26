<br>
<br>

@extends('layouts.app')

@section('content')
<div id="wrapper">

<!-- Start writing here -->

<div class="bookingbox">


@if(Auth::check())

<form action="/carsearch" method="POST" role="search">
	{{csrf_field()}}
		<input type="text" class="form-control" name="p" placeholder="Search Cars">
		<br>
		<br>
			<button type="submit" class="btn btn-primary">Search
	</button>
</form>

	<h3> Search Cars </h3>
	<div class="table-responsive">
	<table class="table table-hover">
		<thead>
			<tr>
				<th>Make</th>
				<th>Model</th>
				<th>Year</th>
				<th>Seats</th>
				<th>Registration</th>
				<th>Status</th>
			</tr>
		</thead>
		@if(isset($details))
		<tbody>
			@foreach($details as $car)
			<tr>
				<td> {{ $car->make }} </td>
				<td> {{ $car->model }} </td>
				<td> {{ $car->year }} </td>
				<td> {{ $car->seating }} </td>
				<td> {{ $car->rego }} </td>
				<form method="post" action="/car/status">
					{{ csrf_field() }}
					<input type="hidden" name="carId" value="{{ $car->id }}">
					@if($car->retired == false)
						<input type="hidden" name="status" value="retire">
						<td><button class="btn btn-primary">Retire</button></td>
					@else
						<input type="hidden" name="status" value="unretire">
						<td><button class="btn btn-primary">Unretire</button></td>
					@endif
				</form>
			</tr>
			@endforeach
		</tbody>
	</table>
	</div>
	@elseif(isset($message))
	<p> {{ $message }} </p>
@endif

@endif

        @if(Auth::guest())
            <a href="/login" class="btn btn-info"> You need to login as admin to continue</a>
            <br>
        @endif

</div>
</div>
@endsection
