<?php

namespace App\Http\Controllers;

use App\Line;
use Illuminate\Http\Request;

use App\Http\Requests;

class LineApiController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data = Line::all();
        return $data->toJson();
    }

    /**
     * Display the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function show($lineId)
    {

        $lineId = intval($lineId);
        if($lineId === null){
            return Response(404);
        }
        $data = Line::with('stations')->find($lineId);

        return $data->toJson();

    }

}
