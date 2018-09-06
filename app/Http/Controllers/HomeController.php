<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use View;

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
        return View::make('home')->with('bookings', $bookings);
    }
}
