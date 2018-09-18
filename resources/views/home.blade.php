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
                    <!-- Start Writing here -->

                    <!-------------------------->
                    @if(!empty($bookings))
                    @foreach ($bookings as $booking)
						Booking ID: {{ $booking->id }}<br>
						<form method="post" action="viewtrip">
							{{ csrf_field() }}
							<input type="hidden" name="bookingId" value="{{ $booking->id }}">
							<input type="submit" value="View Trip">
						</form><br>
                    @endforeach
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
