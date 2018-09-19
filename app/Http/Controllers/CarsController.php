<?php

namespace App\Http\Controllers;

use App\Cars;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;

class CarsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('addcar');
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
        $cars = new Cars;
        $cars->make = $request->input('make');
        $cars->model = $request->input('model');
        $cars->year = $request->input('year');
        $cars->seating = $request->input('seating');
		$cars->rego = $request->input('rego');	
		$cars->lat = $request->input('lat');
		$cars->lng = $request->input('lng');
		$cars->save();
		return redirect('home');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Cars  $cars
     * @return \Illuminate\Http\Response
     */
    public function show(Cars $cars)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Cars  $cars
     * @return \Illuminate\Http\Response
     */
    public function edit(Cars $cars)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Cars  $cars
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Cars $cars)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Cars  $cars
     * @return \Illuminate\Http\Response
     */
    public function destroy(Cars $cars)
    {
        //
    }
    
    public function carsSortedByDistance(Request $request) {
		$limit = $request->input('limit');
		$lat = $request->input('lat');
		$lng = $request->input('lng');
		$startTime = $request->input('startTime');
		$endTime = $request->input('endTime');
		//$cars = Cars::orderByRaw("(POW((lng-(" . $lng . ")),2) + POW((lat-(" . $lat . ")),2))", "asc")->limit($limit)->get();
		$cars = DB::select("select * from cars WHERE id NOT IN (select cars_id from bookings WHERE " . $startTime . " between startTime AND endTime or " . $endTime . " between startTime AND endTime or (" . $startTime . " <= startTime AND " . $endTime . " > endTime)) ORDER BY " . "(POW((lng-(" . $lng . ")),2) + POW((lat-(" . $lat . ")),2))" . " ASC LIMIT " . $limit);
		return $cars;
	}
}
