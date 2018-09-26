<br>
<br>

@extends('layouts.app')

@section('content')
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
                    <br>
                    <br>
                    <!-- Show Booking history -->
					<div class="table-responsive">
                    <table class="table table-striped">
                    <thead>
                        <tr>
                            <th>Booking ID</th>
                            <th>Car</th>
                            <th>Registration No.</th>
                            <th>Start Time</th>
                            <th>End time</th>
                            <th>View Trip</th>
                        </tr>
                    </thead>
                    @if(!empty($bookings))
                    <tbody>
                        @foreach ($bookings as $booking)
                        <tr>
                            <td> {{ $booking->id }} </td>
                            <td> {{ $booking->cars->year }} {{ $booking->cars->make }} {{ $booking->cars->model }}</td>
                            <td> {{ $booking->cars->rego }}</td>
                            <td> {{ $booking->startTime }} </td>
                            <td> {{ $booking->endTime }} </td>
                            <td>   <form method="post" action="viewtrip">
                                    {{ csrf_field() }}
                                    <input type="hidden" name="bookingId" value="{{ $booking->id }}">
                                    <input class="btn btn-primary" type="submit" value="View Trip">
                                    </form><br> </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
                </div>
                 @endif
                    <!-------------------------->           
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
