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
    return view('welcome');
});
Route::get('/app', function() {
	return view('inicio');
});
Route::get('/register', function() {
	return view('register');
});
Route::get('/reset-password', function() {
	return view('resetpassword');
});
Route::get('/reset', function() {
	return view('reset');
});


Route::get('/boletin/{id}', function($id) {
	return view('boletin')->with('id', $id);
});
Route::get('/proceso/{id}', function($id) {
	return view('proceso')->with('id', $id);
});



