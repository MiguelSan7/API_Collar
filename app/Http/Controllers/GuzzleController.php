<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;


class GuzzleController extends Controller
{
    public function apiHTTP()
{
    $responses = [];
    
    for ($i = 1; $i < 8; $i++) {
        switch($i)
        {
            case 1:
                $feed="correa-inteligentetemperatura";
                break;
            case 2:
                $feed="correa-inteligentehumedad";
                break;
            case 3:
                $feed="correa-inteligentevibracion";
                break;
            case 4:
                $feed="correa-inteligenteaceleracionx";
                break;
            case 5:
                $feed="correa-inteligenteaceleracionz";
                break;
            case 6:
                $feed="correa-inteligenteaceleraciony";
                break;
            case 7:
                $feed="correa-inteligentepiezoelectrico";
                break;
        }
        
        $response = Http::withHeaders([
            'X-AIO-Key' => 'aio_mjOU46kWDd8tSrJvwTSLkVxxhg3g',
        ])->get("https://io.adafruit.com/api/v2/Kiilver/feeds/{$feed}/data");
        
        if ($response->ok()) {
            $data = $response->json();
            $value = $data[0]['value'];
            $feedKey = $data[0]['feed_key'];
            
            $responses[] = [
                "feed_key" => $feedKey,
                "value" => $value
            ];
        } else {
            $responses[] = [
                "msg" => "No quema kuh :C",
                "data" => $response->body()
            ];
        }
    }

    // Devuelves todas las respuestas en un solo JSON
    return response()->json($responses, 200);
}
}
