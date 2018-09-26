<?php

namespace App\Http\Controllers;

use App\Cars;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;

class CarStatusController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
		$id = $request->input('carId');
		$status = $request->input('status');
		$car = Cars::find($id);
		if ($status == "retire") {
			$car->retired = true;
			$car->save();
		} else {
			$car->retired = false;
			$car->save();
		}
        return redirect('/carsmanage');
    }

}
