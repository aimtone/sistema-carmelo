<?php

use Illuminate\Http\Request;
 
/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/


Route::middleware('auth:api')->resource('response','ResponseController');
Route::middleware('auth:api')->resource('habitante','HabitanteController');
Route::middleware('auth:api')->resource('candidato','CandidatoController');
Route::middleware('auth:api')->resource('eleccion','EleccionController');
Route::middleware('auth:api')->resource('cargo','CargoController');
Route::middleware('auth:api')->resource('periodo','PeriodoController');
Route::middleware('auth:api')->resource('comite','ComiteController');

Route::middleware('auth:api')->resource('user','UserController');
Route::post('/login', 'API\UserController@login');
Route::post('/register', 'API\UserController@register');

