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
            $this->authData = $this->getAuthorisation();
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

        Search::createNewSearch([
            'searchData'  => json_decode($result)
        ]);

        return collect(json_decode($result));
    }

    private  function getAuthorisation()
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

}
