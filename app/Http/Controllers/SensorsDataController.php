<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\SensorData;

class SensorsDataController extends Controller
{
    public function index()
    {
        $sensorData = SensorData::all();
        return response()->json($sensorData, 200);
    }

    public function store(Request $request)
    {
        $sensorData = SensorData::create($request->all());
        return response()->json($sensorData, 201);
    }

    public function show($id)
    {
        $sensorData = SensorData::findOrFail($id);
        return response()->json($sensorData, 200);
    }

    public function update(Request $request, $id)
    {
        $sensorData = SensorData::findOrFail($id);
        $sensorData->update($request->all());
        return response()->json($sensorData, 200);
    }

    public function destroy($id)
    {
        $sensorData = SensorData::findOrFail($id);
        $sensorData->delete();
        return response()->json(null, 204);
    }
}

