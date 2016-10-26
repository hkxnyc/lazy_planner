<?php

namespace App\Http\Controllers;

use App\Search;
use App\Station;
use Illuminate\Http\Request;

use App\Http\Requests;

class StationController extends Controller
{
    public function getYelpData($stations)
    {
        $yelp = new YelpController();
        $stations = Station::find($stations);
        $businesses = [];
        foreach ($stations as $station) {
            $yelpData = $yelp->getData($station->positionArray());
            $businesses = array_merge($businesses, array_map(function ($obj) use ($station) {
                $obj->station = $station->id;
                return $obj;
            },$yelpData['businesses']));
        }
        uasort($businesses, function ($obj1, $obj2) {
            return $obj1->distance > $obj2->distance ? 1 : -1;
        });
        return ['businesses'=>$businesses,'stations'=>$stations];
    }

    public function showYelpData(Request $request){
        $data = $this->getYelpData($request->get('stations'));
        $s = Search::createNewSearch($data);
        return redirect()->route('stations.search',['slug'=>$s->slug]);
    }
}
