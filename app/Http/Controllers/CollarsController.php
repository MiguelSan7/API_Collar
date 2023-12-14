<?php

namespace App\Http\Controllers;

use App\Models\Collar;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class CollarsController extends Controller
{
    public function create_collar(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'id'=>'required|int'
        ]);
        if($validator->fails())
        {
            return response()->json(['message' => 'Validation failed', 'errors' => $validator->errors()], 422);
        }
        $collar=Collar::create();
        return response()->json([
            'message' => 'Successfully created a collar!',
            'data' => $collar
        ], 201);

    }

    public function index()
    {
        $collars = Collar::all();

        return response()->json([
            'message' => 'Successfully retrieved collars!',
            'data' => $collars,
        ], 200);
    }

    public function show($id)
    {
        $collar = Collar::find($id);

        if (!$collar) {
            return response()->json(['message' => 'Collar not found.'], 404);
        }

        return response()->json([
            'message' => 'Successfully retrieved collar!',
            'data' => $collar,
        ], 200);
    }

    public function store(Request $request)
    {
        // Validación de los datos antes de crear el collar
        $validator = Validator::make($request->all(), [
            'nombre' => 'required|string',
            // Agrega aquí las reglas de validación adicionales según tus necesidades
        ]);

        if ($validator->fails()) {
            return response()->json(['message' => 'Validation failed', 'errors' => $validator->errors()], 422);
        }

        $collar = Collar::create($request->all());

        return response()->json([
            'message' => 'Successfully created collar!',
            'data' => $collar,
        ], 201);
    }

    public function update(Request $request, $id)
    {
        // Validación de los datos antes de actualizar el collar
        $validator = Validator::make($request->all(), [
            'nombre' => 'required|string',
            // Agrega aquí las reglas de validación adicionales según tus necesidades
        ]);

        if ($validator->fails()) {
            return response()->json(['message' => 'Validation failed', 'errors' => $validator->errors()], 422);
        }

        $collar = Collar::find($id);

        if (!$collar) {
            return response()->json(['message' => 'Collar not found.'], 404);
        }

        $collar->update($request->all());

        return response()->json([
            'message' => 'Successfully updated collar!',
            'data' => $collar,
        ], 200);
    }

    public function destroy($id)
    {
        $collar = Collar::find($id);

        if (!$collar) {
            return response()->json(['message' => 'Collar not found.'], 404);
        }

        $collar->delete();

        return response()->json([
            'message' => 'Successfully deleted collar!',
        ], 200);
    }
}
