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
Route::get('example/{id}',['as' =>'stations.example','uses'=>'StationController@example']);

Route::post('stations/data',['as' => 'stations.yelpdata','uses'=>'StationController@showYelpData']);



Route::get('search/{slug}',['as'=>'stations.search','uses'=>'SearchController@show']);