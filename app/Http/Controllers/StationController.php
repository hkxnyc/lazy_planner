<?php

namespace App\Http\Controllers;

use App\Station;
use Illuminate\Http\Request;

use App\Http\Requests;

class StationController extends Controller
{
    public function example(Request $request){
        dd(Station::find($request->get('stations'))->map(function($obj){
           return $obj->positionArray();
        }));
    }

}
