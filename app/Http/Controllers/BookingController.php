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
        if (session()->exists('carId')) {
			$carId = session()->pull('carId');
			$startTime = session()->pull('startTime');
			$endTime = session()->pull('endTime');
			if (Auth::user()->type == "suspended") {
				return redirect('/');
			}
			$req = new \Illuminate\Http\Request();
			$req->setMethod('POST');
			$req->request->add(['carId' => $carId]);
			$req->request->add(['endTime' => $endTime]);
			$req->request->add(['startTime' => $startTime]);
			$ret = $this->store($req);
			return $ret;
		}
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
		if (Auth::check()) {
			$carId = $request->input('carId');
			$startTime = $request->input('startTime');
			$endTime = $request->input('endTime');
			$user = Auth::user();
			$car = Cars::where('id', $carId)->first();
			$booking = new Booking;
			$booking->startTime = $startTime;
			$booking->endTime = $endTime;
        
			$trip = FLocationData::getTrip($car->lat, $car->lng);
        
			$booking->trip = json_encode($trip);
        
			$lastLocIndex = count($trip)-1;
			$newLat = $trip[$lastLocIndex][0];
			$newLng = $trip[$lastLocIndex][1];
        
			$booking->save();
			$user->bookings()->save($booking);
			$car->bookings()->save($booking);
        
			$car->lat = (float) $newLat;
			$car->lng = (float) $newLng;
			$car->save();
        
			return redirect('home');
		} else {
			$request->session()->put('carId', $request->input('carId'));
			$request->session()->put('startTime', $request->input('startTime'));
			$request->session()->put('endTime', $request->input('endTime'));
			return redirect('login');
		}
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
