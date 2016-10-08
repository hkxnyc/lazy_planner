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
//
//Route::get('/user', function (Request $request) {
//    return $request->user();
//})->middleware('auth:api');


Route::get('/lines/', ['as'=>'api.lines.index','uses'=>'LineApiController@index']);
Route::get('/lines/{lineId}', ['as'=>'api.lines.show', 'uses' => 'LineApiController@show']);


//Route::get('/lines/{lineId}/stations', function (Request $request){
//    $data = [
//        [
//            "id" => 1,
//            "name" => "Stationz"
//        ]
//    ];
//    return Response::json($data);
//});

Route::post('search', function (Request $request){
    return Response::json($request->all());
});