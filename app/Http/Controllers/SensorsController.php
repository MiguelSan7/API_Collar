<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Sensor;

class SensorsController extends Controller
{
    public function index()
    {
        $sensors = Sensor::all();
        return response()->json($sensors, 200);
    }

    public function store(Request $request)
    {
        $sensor = Sensor::updateOrCreate(
            ['nombre' => $request->nombre],
            ['unidad' => $request->unidad_medida]
        );
        
        return response()->json($sensor, 201);
    }

    public function show($id)
    {
        $sensor = Sensor::findOrFail($id);
        return response()->json($sensor, 200);
    }

    public function update(Request $request, $id)
    {
        $sensor = Sensor::findOrFail($id);
        $sensor->update($request->all());
        return response()->json($sensor, 200);
    }

    public function destroy($id)
    {
        $sensor = Sensor::findOrFail($id);
        $sensor->delete();
        return response()->json(null, 204);
    }
}


