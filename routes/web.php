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
Route::get('example/{id}',function($id){
    $y =  new \App\Http\Controllers\YelpController();
    $s = \App\Station::find($id);
    return $y->getData([
        'latitude'=>$s->latitude,
        'longitude'=>$s->longitude
    ]);
});

Route::get('search/{slug}',function($slug){
   $s = \App\Search::find($slug);
    return collect($s->data);
});