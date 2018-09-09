<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

use Illuminate\Support\Facades\Input;
use App\User;

/* search route */
Route::any('/search',function(){
	$q = Input::get('q');
	if($q != ""){
		$user = User::where('name','LIKE','%'. $q .'%')
						->orWhere('fname','LIKE', '%' . $q . '%')
						->orWhere('lname','LIKE', '%' . $q . '%')
						->orWhere('email','LIKE', '%' . $q . '%')
						->get();
		if(count($user) > 0)
			return view('users')->withDetails($user)->withQuery($q); 
	}
	return view ('users')->withMessage("No Users found!");
});



Route::get('/', function () {
	if (Auth::check()) {
		if (Auth::user()->isAdmin()) {
			return view('home');
		} else {
			return view('home');
		}
	}
	return view('welcome');
});

Route::get('/booking', function () {
    return view('booking');
});

Route::get('/faq', function () {
    return view('faq');
});

/*Admin to view car table  */
Route::get('/admin', function () {
	$car = DB::select('SHOW TABLES');
    return view('admin', compact('admin'));
});



Route::get('/users', function () {
    return view('users');
});

Route::get('/booklater', function () {
    return view('booklater');
});

Route::resource('/addcar', 'CarsController');

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

Route::get('/booknow', function () {
    return view('booknow');
});

Route::resource('/book', 'BookingController');
