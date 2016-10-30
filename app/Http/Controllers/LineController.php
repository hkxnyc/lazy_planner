<?php

namespace App\Http\Controllers;

use App\Line;
use Illuminate\Http\Request;

use App\Http\Requests;

class LineController extends Controller
{
    public function index()
    {
        $lines = Line::all();
        return view('exampleline')->with([
            'lines'=>$lines,
            'title'=>'Viewing All Lines'
        ]);
    }

    public function show($lineId)
    {
        $lines = Line::with('stations')->where('name','like',$lineId)->first();

        return view('examplestations')->with([
            'line'=>$lines,
            'title' => 'Viewing Line: '.$lines->name
        ]);
    }

    public function getDataFromYelp($latitude,$longitude)
    {
        $ch = curl_init();
    }
}
