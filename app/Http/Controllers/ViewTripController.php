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
        
        $tripJson = $booking->trip;
        return View::make('viewtrip')->with('tripJson', $tripJson);
    }
}
