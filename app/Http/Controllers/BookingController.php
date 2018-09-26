<?php

namespace App\Http\Controllers;

use App\Booking;
use App\Cars;
use App\User;
use Illuminate\Http\Request;
use Auth;

class BookingController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $carId = $request->input('carId');
        $startTime = $request->input('startTime');
        $endTime = $request->input('endTime');
        $user = Auth::user();
        $car = Cars::where('id', $carId)->first();
        $booking = new Booking;
        $booking->startTime = $startTime;
        $booking->endTime = $endTime;
		
		// if booking created, its not in middle of another
		// doesnt end when another starts
		// doesnt start when another ends
		
		
		/* ATTEMPT 1; This attempt was taken from: https://dba.stackexchange.com/questions/52794/query-select-all-rooms-which-are-not-booked
		However no table booking_map 
		$currentlyFreeQuery = mysql_query("SELECT *
										FROM Cars AS c
										WHERE c.id NOT IN(
											SELECT c.car_id
											FROM Booking AS b
											JOIN booking_map AS m
											ON b.id = m.id
											WHERE b.begin <= startTime
											AND b.end >= startTime")
										)
		*/
		
		/* ATTEMPT 2; possibly work, however once a car has had a booking id attached, would it ever be bookable again? (WHERE Bookings.carId IS NULL)
		SELECT *
		FROM Cars
		LEFT JOIN Bookings ON
			Bookings.carId = Cars.id
			AND startTime >= '$startTime' 
			AND startTime <= '$endTime'
		WHERE 
			Bookings.carId IS NULL
		*/
		
		/* ATTEMPT 3; Simplest but possibly works
		SELECT * FROM Cars 
		WHERE (startTime >= '$startTime' 
		AND endTime <= '$endTime'
		)	
		*/
		
		// To see if time range A overlaps with time range B, 
		// you need to check if A's start is before B's end 
		// AND A's end is after B's start. If both are true, then the range overlaps.
		
		/* ATTEMPT 4; gets error */
		/*$checkBookingQuery = mysql_query("SELECT distinct(cars.id) FROM cars
										where cars.id not in (
											select b.model from bookings b 
											WHERE (b.startTime >= '$startTime' and b.endTime <= '$endTime')");
		$checkBooking = mysql_query($checkBookingQuery);
        
		if(mysql_num_rows($checkBooking)) {
			echo 'Booking unavailable. Please select anoher car or book later option. ';
		} else */
			$booking->save();
			$user->bookings()->save($booking);
			$car->bookings()->save($booking);
			return redirect('home');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Booking  $booking
     * @return \Illuminate\Http\Response
     */
    public function show(Booking $booking)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Booking  $booking
     * @return \Illuminate\Http\Response
     */
    public function edit(Booking $booking)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Booking  $booking
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Booking $booking)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Booking  $booking
     * @return \Illuminate\Http\Response
     */
    public function destroy(Booking $booking)
    {
        //
    }
	
	// 
}
