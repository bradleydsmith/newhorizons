<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class GeocodeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $location = urlencode($request->input('location'));
		$url = "http://www.mapquestapi.com/geocoding/v1/address?key=lYrP4vF3Uk5zgTiGGuEzQGwGIVDGuy24&location=" . $location;
		$curl = curl_init();
		curl_setopt_array($curl, array(
			CURLOPT_RETURNTRANSFER => 1,
			CURLOPT_URL => $url
		));
		$result = curl_exec($curl);
		return $result;
    }
}
