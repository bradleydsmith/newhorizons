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

Route::get('/admin', function () {
    return view('admin');
});

Route::get('/users', function () {
    return view('users');
});

Route::resource('/addcar', 'CarsController');

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
