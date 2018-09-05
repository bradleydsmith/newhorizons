<br>
<br>

@extends('layouts.app')

@section('content')
<div id="wrapper">


<div class="bookingbox">
@if(Auth::check())  <!-- Change to isAdmin -->

<!-- Start writing here -->

<table class="table table-striped">
		<thead>
			<tr>

				<th>Car ID</th>
				<th>Make</th>
				<th>Model</th>
				<th>Year</th>
				<th>Seating</th>
			</tr>
		</thead>
		@if(isset($cars))
		<tbody>
		@foreach ($cars as $car)	
			<tr>
				<th>{{ $car->model }}</th>
				<th>{{ $car->year }}</th>
			</tr>
		</tbody>
		@endforeach	
	</table>
	@endif




<!------------------------>
@endif

</div>
        @if(Auth::guest())
            <a href="/login" class="btn btn-info"> You need to login as admin to continue</a>
            <br>
        @endif
</div>
<br>
</div>


</div> <!-- div wrapper -->

@endsection
