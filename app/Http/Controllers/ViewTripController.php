<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use View;
use App\Booking;

class ViewTripController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        //return view('home');
        $bookingId = $request->input("bookingId");
        $booking = Booking::find($bookingId);
        
        $trip = json_decode($booking->trip);
        $tripUrl = "/api/staticmap?format=jpg&size=400x400&markers=color:green|size:small|";
        $tripUrl = $tripUrl . $trip[0][0] . "," . $trip[0][1];
        $tripUrl = $tripUrl . "&markers2=color:red|size:small|";
        $tripUrl = $tripUrl . $trip[count($trip)-1][0] . "," . $trip[count($trip)-1][1];
        $tripUrl = $tripUrl . "&path=";
        for ($i = 0; $i < count($trip)-1; $i++) {
			$tripUrl = $tripUrl . $trip[$i][0] . "," . $trip[$i][1] . "|";
		}
		$tripUrl = $tripUrl . $trip[count($trip)-1][0] . "," . $trip[count($trip)-1][1];
        return View::make('viewtrip')->with('tripUrl', $tripUrl);
    }
}
