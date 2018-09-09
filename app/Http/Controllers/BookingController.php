<?php

namespace App\Http\Controllers;

use App\Booking;
use App\Cars;
use App\User;
use App\FLocationData;
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
        
        $booking->trip = FLocationData::getTrip($car->lat, $car->lng);
        
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
}
