<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| This file is where you may define all of the routes that are handled
| by your application. Just tell Laravel the URIs it should respond
| to using a Closure or controller method. Build something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});



Route::get('/lines/', ['as'=>'lines.index','uses'=>'LineController@index']);
Route::get('/lines/{lineId}', ['as'=>'lines.show', 'uses' => 'LineController@show']);
Route::post('example',['as'=>'stations.example', 'uses'=>'StationController@example']);