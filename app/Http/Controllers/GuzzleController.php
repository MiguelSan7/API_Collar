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
            case 8:
                $feed="correa-inteligentebuzzer";
                break;
            case 9:
                $feed="correa-inteligentelatitud";
                break;
            case 10:
                $feed="correa-inteligentelongitud";
                break;
            
        }
        
        $response = Http::withHeaders([
            'X-AIO-Key' => 'aio_qxBF70TW4QtPUt5ITONzGO3ctpiJ',
        ])->get("https://io.adafruit.com/api/v2/Kiilver/feeds/{$feed}/data");
        
        if ($response->ok()) {
            $data = $response->json();
            $value = $data[0]['value'];
            $feedKey = $data[0]['feed_key'];
            
            $responses[] = [
                "feed_key" => $feedKey,
                "value" => $value
            ];
            return response()->json(['sensor_data'=> $responses, 200]);
        } else {
            $responses[] = [
                "msg" => "No quema kuh :C",
                "data" => $response->body()
            ];
            return response()->json($responses, 401);
        }
    }

    // Devuelves todas las respuestas en un solo JSON
    return response()->json($responses, 200);
}
public function controlarBuzzer(Request $request) {
    $data = json_decode($request->getContent(), true);
    $valor = isset($data['value']) ? $data['value'] : 0;

    $response = Http::withHeaders([
        'X-AIO-Key' => 'aio_qxBF70TW4QtPUt5ITONzGO3ctpiJ',
        'Content-Type' => 'application/json',
    ])->post("https://io.adafruit.com/api/v2/Kiilver/feeds/correa-inteligentebuzzer/data", [
        'value' => $valor
    ]);

    if ($response->ok()) {
        $accion = $valor == 0 ? 'apagar' : 'encender';

        return response()->json([
            "msg" => "Buzzer $accion correctamente",
        ], 200);
    } else {
        return response()->json([
            "msg" => "No se ha podido realizar la acción en el buzzer...",
            "data" => $response->body(),
        ], 400);
    }
}
    
}