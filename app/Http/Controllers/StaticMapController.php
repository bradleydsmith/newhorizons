<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class StaticMapController extends Controller
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
		$url = "https://maps.googleapis.com/maps/api/staticmap?";
		$url = $url . "format=" . $request->input("format");
		$url = $url . "&size=" . $request->input("size");
		$url = $url . "&markers=" . $request->input("markers");
		$url = $url . "&markers=" . $request->input("markers2");
		$url = $url . "&path=" . $request->input("path");
		$curl = curl_init();
		curl_setopt_array($curl, array(
			CURLOPT_RETURNTRANSFER => 1,
			CURLOPT_URL => $url
		));
		$result = curl_exec($curl);
		return $result;
    }
}
