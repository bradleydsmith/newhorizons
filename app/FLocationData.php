<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class FLocationData
{
	public static function getDestinationLatLng($lat, $lng) {
		srand(time(0));
		$url = "https://nominatim.openstreetmap.org/search.php?q=cafes+near+Melbourne+VIC+3000&format=json&limit=30";
		$curl = curl_init();
		curl_setopt_array($curl, array(
			CURLOPT_RETURNTRANSFER => 1,
			CURLOPT_URL => $url,
			CURLOPT_REFERER => "http://newhorizonsrmit.tk"
		));
		$result = curl_exec($curl);
		$resultJson = json_decode($result);
		
		$dest = rand(0,count($resultJson)-1);
		
		$lngLat = new \stdClass();
        $lngLat->lng = $resultJson[$dest]->lon;
        $lngLat->lat = $resultJson[$dest]->lat;
        
        return $lngLat;
	}
	
	public static function getTrip($lat, $lng) {
		$dest = FLocationData::getDestinationLatLng($lat, $lng);
		$url = "http://www.mapquestapi.com/directions/v2/route?key=lYrP4vF3Uk5zgTiGGuEzQGwGIVDGuy24&from=" . $lat . "," . $lng . "&to=" . $dest->lat . "," . $dest->lng . "&narrativeType=none";
		$curl = curl_init();
		curl_setopt_array($curl, array(
			CURLOPT_RETURNTRANSFER => 1,
			CURLOPT_URL => $url
		));
		$result = curl_exec($curl);
		$resultJson = json_decode($result);
		$trip = array(array($lat, $lng));
		for ($i = 0; $i < count($resultJson->route->legs); $i++) {
			for ($j = 0; $j < count($resultJson->route->legs[$i]->maneuvers); $j++) {
				$tLat = (string) $resultJson->route->legs[$i]->maneuvers[$j]->startPoint->lat;
				$tLng = (string) $resultJson->route->legs[$i]->maneuvers[$j]->startPoint->lng;
				array_push($trip, array($tLat, $tLng));
			}
		}
		array_push($trip, array($dest->lat, $dest->lng));
		return json_encode($trip);
	}
}
