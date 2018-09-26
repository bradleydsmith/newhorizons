<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;

class UserStatusController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
		$id = $request->input('userId');
		$status = $request->input('status');
		$user = User::find($id);
		if ($status == "suspend") {
			$user->type = "suspended";
			$user->save();
		} else {
			$user->type = "user";
			$user->save();
		}
        return redirect('/users');
    }

}
