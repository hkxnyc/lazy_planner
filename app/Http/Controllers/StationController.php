<?php

namespace App\Http\Controllers;

use App\Search;
use App\Station;
use Illuminate\Http\Request;

use App\Http\Requests;

class StationController extends Controller
{
    public function getYelpData($stations,$query = null)
    {
        $yelp = new YelpController();
        $stations = Station::find($stations);
        $businesses = [];
        foreach ($stations as $station) {
            $queryInput = $station->positionArray();
            if($query && trim($query) !== ''){
                $queryInput['term'] = trim($query);
            }
            $yelpData = $yelp->getData($queryInput);
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

    public function showYelpData(Request $request)
    {
        $this->validate($request,[
           'stations' => 'required|array|min:3|max:5'
        ],[
            'stations.required' => 'You must pick 3 stations to search near.',
            'stations.min' => 'You must pick at least 3 stations to search near and no more than 5',
            'stations.max' => 'You must pick no more that 5 stations to search near and no less than 3'
        ]);
        $data = $this->getYelpData($request->get('stations'),$request->get('query'));
        $s = Search::createNewSearch($data);
        return redirect()->route('stations.search',['slug'=>$s->slug]);
    }
}
