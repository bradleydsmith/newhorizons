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
use App\Cars;

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

//maybe do this for car management

Route::any('/carsearch',function(){
	$p = Input::get('p');
	if($p != ""){
		$car = Cars::where('make','LIKE','%'. $p .'%')
						->orWhere('model','LIKE', '%' . $p . '%')
						->orWhere('year','LIKE', '%' . $p . '%')
						->orWhere('seating','LIKE', '%' . $p . '%')
						->orWhere('rego','LIKE', '%' . $p . '%')
						->get();
		if(count($car) > 0)
			return view('carsmanage')->withDetails($car)->withQuery($p);
	}
	return view ('carsmanage')->withMessage("No Cars found!");
});




Route::get('/', function () {
	if (Auth::check()) {
		if (Auth::user()->isAdmin()) {
			return view('welcome');
		} else {
			return view('welcome');
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

Route::get('/carsmanage', function () {
    return view('carsmanage');
});

Route::get('/booklater', function () {
    return view('booklater');
});

Route::resource('/addcar', 'CarsController');

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

Route::post('/viewtrip', 'ViewTripController@index')->name('viewtrip');

Route::get('/booknow', function () {
    return view('booknow');
});

Route::post('/car/status', 'CarStatusController@index')->name('carstatus');
Route::post('/user/status', 'UserStatusController@index')->name('userstatus');

Route::resource('/book', 'BookingController');
Route::post('/confirm', 'ConfirmController@index')->name('confirm');
Route::get('/confirm', 'ConfirmController@index')->name('confirm');
