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
                    <!-- Start Writing here -->
                    <table class="table table-striped">
                    <thead>
                        <tr>
                            <th>Booking ID</th>
                            <th>Car</th>
                            <th>Duration</th>
                            <th>Date</th>
                            <th>Paid</th>
                            <th>View</th>
                        </tr>
                    </thead>
                    <!-------------------------->
                    <tbody>
                    @if(!empty($bookings))
                    @foreach ($bookings as $booking)
                    <tr>
						<td>{{ $booking->id }} </td>
                        <td>{{ $booking->cars_id}} </td>
                        <td>{{ $booking->startTime}}</td>
                        <td>{{ $booking->created_at}}</td>
                        <td>{{ $booking->paid}}</td>
                        <td> <form method="post" action="viewtrip">
                             {{ csrf_field() }}
                             <input type="hidden" name="bookingId" value="{{ $booking->id }}">
                             <input type="submit" class="btn btn-default btn-info" value="View Trip">
                             </form> </td>

                    @endforeach
                    @endif
                    </tr>
                </tbody>

                </div>
            </div>
        </div>
    </div>
</div>
@endsection
