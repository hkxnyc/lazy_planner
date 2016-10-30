<?php

namespace App\Http\Controllers;

use App\Search;
use Illuminate\Http\Request;

use App\Http\Requests;

class YelpController extends Controller
{
    private $url = "https://api.yelp.com/v3/businesses/search";
    private $authData;


    public function getData(array $query)
    {
        if(!isset($this->authData) || is_null($this->authData))
            $this->authData = $this->getAuthorization();
        $header = ['Authorization: '.$this->authData->get('token_type').' '.$this->authData->get('access_token')];
        $queryString = http_build_query($query);

        $ch = curl_init();

        $this->setCurlOpts($ch,[
            CURLOPT_URL => $this->url . '?' . $queryString,
            CURLOPT_HTTPHEADER => $header,
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_HEADER => false,
        ]);

        $result = curl_exec($ch);

        $collectedResults = collect(json_decode($result));
        $this->addDistancesToBusinesses($collectedResults,$query);

        return $collectedResults;
    }

    private  function getAuthorization()
    {
        $ch = curl_init();

        $fields = [
            'grant_type' => 'client_credentials',
            'client_id' => env('YELP_CLIENT_ID'),
            'client_secret' => env('YELP_CLIENT_SECRET'),
        ];

        $this->setCurlOpts($ch, [
            CURLOPT_POST => true,
            CURLOPT_URL => 'https://api.yelp.com/oauth2/token',
            CURLOPT_POSTFIELDS => $fields,
            CURLOPT_RETURNTRANSFER =>true,
            CURLOPT_HEADER => false,
        ]);

        $result = curl_exec($ch);
        curl_close($ch);

        return collect(json_decode($result));
    }


    private function setCurlOpts(&$ch, array $curlOpts)
    {
        foreach ($curlOpts as $opt => $val) {
            curl_setopt($ch, $opt, $val);
        }
    }

    private function addDistancesToBusinesses(&$yelpResults,$query)
    {
        foreach($yelpResults["businesses"] as $yelp){
            $this->addDistanceInMiles($yelp,$query);
        }
    }

    private function addDistanceInMiles(&$business,$query)
    {
        $lon1 = $query["longitude"];
        $lat1 = $query["latitude"];
        $lon2 = $business->coordinates->longitude;
        $lat2 = $business->coordinates->latitude;
        $theta = $lon1 - $lon2;
        $dist = sin(deg2rad($lat1)) * sin(deg2rad($lat2)) +  cos(deg2rad($lat1)) * cos(deg2rad($lat2)) * cos(deg2rad($theta));
        $dist = acos($dist);
        $dist = rad2deg($dist);
        $miles = $dist * 60 * 1.1515;

        $business->distance = $miles;
    }
}
