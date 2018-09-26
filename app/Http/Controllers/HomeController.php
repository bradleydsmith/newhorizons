<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use View;
use DateTime;

class HomeController extends Controller
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
    public function index()
    {
        //return view('home');
        $user = Auth::user();
        $bookings = $user->bookings()->get();
        if (!empty($bookings)) {
			for ($i = 0; $i < count($bookings); $i++) {
				$startDate = DateTime::createFromFormat('U', $bookings[$i]->startTime);
				$bookings[$i]->startTime = $startDate->format('d/m/y h:i a');
				$endDate = DateTime::createFromFormat('U', $bookings[$i]->endTime);
				$bookings[$i]->endTime = $endDate->format('d/m/y h:i a');
				
			}
		}
        return View::make('home')->with('bookings', $bookings);
    }
}
