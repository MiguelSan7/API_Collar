<?php

namespace App\Http\Controllers;

use App\Models\Pet;
use Illuminate\Http\Request;

class PetsController extends Controller
{
    public function index()
    {
        $pets = Pet::all();

        return response()->json([
            'message' => 'Successfully retrieved pets!',
            'data' => $pets,
        ], 200);
    }

    public function show($id)
    {
        $pet = Pet::find($id);

        if (!$pet) {
            return response()->json(['message' => 'Pet not found.'], 404);
        }

        return response()->json([
            'message' => 'Successfully retrieved pet!',
            'data' => $pet,
        ], 200);
    }

    public function store(Request $request)
    {
        // Falta validar los datos del request antes de crearlos.

        $pet = Pet::create($request->all());

        return response()->json([
            'message' => 'Successfully created pet!',
            'data' => $pet,
        ], 201);
    }

    public function update(Request $request, $id)
    {
        // falta validar los datos del request antes de actualizarlos.

        $pet = Pet::find($id);

        if (!$pet) {
            return response()->json(['message' => 'Pet not found.'], 404);
        }

        $pet->update($request->all());

        return response()->json([
            'message' => 'Successfully updated pet!',
            'data' => $pet,
        ], 200);
    }

    public function destroy($id)
    {
        $pet = Pet::find($id);

        if (!$pet) {
            return response()->json(['message' => 'Pet not found.'], 404);
        }

        $pet->delete();

        return response()->json([
            'message' => 'Successfully deleted pet!',
        ], 200);
    }

    public function getPetByOwner($id)
    {
        // Mañana le meto la logica a esto, que hoy no me da la cabeza para más.
        return response()->json([
            'message' => 'Successfully retrieved pets by owner!',
        ], 200);
    }

    public function getPetByCollar($id)
    {
        // Mañana le meto la logica a esto, que hoy no me da la cabeza para más.

        return response()->json([
            'message' => 'Successfully retrieved pets by collar!',
        ], 200);
    }
}
