<?php

namespace App\Http\Controllers;

use App\Models\Pet;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\DB;

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
        // Validación de los datos antes de crear la mascota
        $validator = Validator::make($request->all(), [
            'nombre' => 'required|string',
            'peso' => 'required|string',
            'id_collar' => 'required|exists:collars,id_collar',
            'id_usuario' => 'required|exists:users,id_usuario',
        ]);

        if ($validator->fails()) {
            return response()->json(['message' => 'Validation failed', 'errors' => $validator->errors()], 422);
        }

        $pet = Pet::create($request->all());

        return response()->json([
            'message' => 'Successfully created pet!',
            'data' => $pet,
        ], 201);
    }

    public function update(Request $request, $id)
    {
        // Validación de los datos antes de actualizar la mascota
        $validator = Validator::make($request->all(), [
            'nombre' => 'required|string',
            'peso' => 'required|string',
            'id_collar' => 'required|exists:collars,id_collar',
            'id_usuario' => 'required|exists:users,id_usuario',
        ]);

        if ($validator->fails()) {
            return response()->json(['message' => 'Validation failed', 'errors' => $validator->errors()], 422);
        }

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

    public function MyPets(Request $request, int $id)
    {
        $result = DB::select('SELECT count(pets.nombre) as "MyPets"
        FROM pets
        INNER JOIN users ON users.id = pets.id_usuario
        WHERE pets.id_usuario = :id
        GROUP BY pets.nombre
    ', [":id"=>$id]);
        

    if ($result != null) {
        $pets_res = DB::select('SELECT pets.nombre as MyPets FROM pets
            INNER JOIN users ON users.id = pets.id_usuario
            WHERE pets.id_usuario = :id
        ', [":id"=>$id]);
    
        return response()->json(
            [
                'pets' => $pets_res],200);
    } else {
        return response()->json(
            [
                "msg" => "You don't have any registered pets!"
            ], 401);
        }
    }   
}