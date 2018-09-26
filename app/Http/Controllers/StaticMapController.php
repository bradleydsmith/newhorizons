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
		
		$userAgent = "Mozilla/5.0 (X11; Linux x86_64) AppleWebKit/537.36 (KHTML, like Gecko) Ubuntu Chromium/69.0.3497.81 Chrome/69.0.3497.81 Safari/537.36";
		
		$curl = curl_init();
		
		/*curl_setopt_array($curl, array(
			CURLOPT_AUTOREFERER => false,
			CURLOPT_RETURNTRANSFER => 1,
			CURLOPT_URL => $url,
			CURLOPT_USERAGENT => $userAgent
		));*/
		
		$header[0]  = "Accept: text/xml,application/xml,application/xhtml+xml,"; 
		$header[0] .= "text/html;q=0.9,text/plain;q=0.8,image/png,*/*;q=0.5";

		$header[] = "Cache-Control: max-age=0"; 
		$header[] = "Connection: keep-alive"; 
		$header[] = "Keep-Alive: 300"; 
		$header[] = "Accept-Charset: ISO-8859-1,utf-8;q=0.7,*;q=0.7"; 
		$header[] = "Accept-Language: en-us,en;q=0.5"; 
		$header[] = "Pragma: "; // browsers = blank
		
		curl_setopt_array($curl, array(
			CURLOPT_AUTOREFERER => false,
			CURLOPT_RETURNTRANSFER => 1,
			CURLOPT_URL => $url,
			CURLOPT_USERAGENT => $userAgent,
			CURLOPT_HTTPHEADER => $header,
			CURLOPT_REFERER => 'http://www.google.com',
			CURLOPT_ENCODING => 'gzip,deflate'
		));
		
		$result = curl_exec($curl);
		return $result;
    }
}
