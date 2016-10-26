<?php

namespace App\Http\Controllers;

use App\Search;
use Illuminate\Http\Request;

use App\Http\Requests;

class SearchController extends Controller
{


    public function show(Search $slug){
        $map = [];

        foreach ($slug->data->stations as $k=>$s){
            $map[$s->id] = $k;
        }
        return view('station.businesses',[
            'data'=>$slug->data,
            'map' => $map,
        ]);
    }
}