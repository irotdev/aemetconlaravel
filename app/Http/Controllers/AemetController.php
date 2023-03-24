<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class AemetController extends Controller
{
    public function index() {
        return view ('index');
    }

    public function search(Request $request) {
        $data = $request->validate([
            'city' => 'required'
        ]);
        $cityNotFound = null;
        $city = $data['city'];
        switch($city) {
            case "Águilas":
                $codeCity = "7002Y";
                break;
            case "Cartagena":
                $codeCity = "7012D";
                break;
            case "Lorca":
                $codeCity = "7209";
                break;
            case "Mazarrón":
                $codeCity = "7007Y";
                break;
            case "Murcia":
                $codeCity = "7178I";
                break;
            default:
                $cityNotFound = "No has indicado ninguna de las ciudades elegibles, por lo que te pondré la más bonita de España";
                $codeCity = config('services.owm.municipality');
        }



        $found = false;
        $url = "https://opendata.aemet.es/opendata/api/observacion/convencional/datos/estacion/" . $codeCity . "/?api_key=" . config('services.owm.aemetkey');
        $response = Http::get($url)->json();

        if($response['estado'] == "200") {    
            $urlData = $response["datos"];
            $json = "{\"data\": " . mb_convert_encoding(Http::get($urlData), 'UTF-8', 'ISO-8859-1') . "}";
            $response2 = json_decode($json, true);
            $lastValue = end($response2["data"]);
            $city = $lastValue['ubi'];
            $temperatureNow = $lastValue['ta'];
            $temperatureMax = $lastValue['tamax'];
            $temperatureMin = $lastValue['tamin'];
            $found = true;
            
            return view('index', compact('found', 'city', 'cityNotFound', 'temperatureNow', 'temperatureMax', 'temperatureMin'));
        }

        return view('index', compact('found'));
    }
}
