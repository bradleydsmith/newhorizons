<?php

namespace App\Http\Controllers;

use App\Booking;
use App\Cars;
use App\User;
use App\FLocationData;
use Illuminate\Http\Request;
use Auth;
use View;
use DateTime;

class ConfirmController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        if (Auth::check()) {
			if (session()->exists('carId')) {
				$carId = session()->pull('carId');
				$startTime = session()->pull('startTime');
				$endTime = session()->pull('endTime');
				if (Auth::user()->type == "suspended") {
					return redirect('/');
				}
				$startDate = DateTime::createFromFormat('U', $startTime);
				$startDate = $startDate->format('d/m/y h:i a');
				$endDate = DateTime::createFromFormat('U', $endTime);
				$endDate = $endDate->format('d/m/y h:i a');
				$car = Cars::find($carId);
				$cost = ((($endTime - $startTime) / 60) / 60) * $car->pph;
				$cost = round($cost, 2);
				return View::make('confirm')->with('car', $car)->with('startTime', $startTime)->with('endTime', $endTime)->with('startDate', $startDate)->with('endDate', $endDate)->with('cost', $cost);
			} elseif (!empty($request->input('carId'))) {
				$carId = $request->input('carId');
				$startTime = $request->input('startTime');
				$endTime = $request->input('endTime');
				$startDate = DateTime::createFromFormat('U', $startTime);
				$startDate = $startDate->format('d/m/y h:i a');
				$endDate = DateTime::createFromFormat('U', $endTime);
				$endDate = $endDate->format('d/m/y h:i a');
				$car = Cars::find($carId);
				$cost = ((($endTime - $startTime) / 60) / 60) * $car->pph;
				$cost = round($cost, 2);
				return View::make('confirm')->with('car', $car)->with('startTime', $startTime)->with('endTime', $endTime)->with('startDate', $startDate)->with('endDate', $endDate)->with('cost', $cost);
			}
		} elseif (!empty($request->input('carId'))) {
			$request->session()->put('carId', $request->input('carId'));
			$request->session()->put('startTime', $request->input('startTime'));
			$request->session()->put('endTime', $request->input('endTime'));
			return redirect('login');
		}
		return redirect('/');
    }
}
