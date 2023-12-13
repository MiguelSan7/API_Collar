<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\User;
use Illuminate\Support\Facades\Validator;

class PetsController extends Controller
{
    public function MyPets(Request $request, int $id)
    {
        $result = DB::select('SELECT count(pets.nombre) as "MyPets"
        FROM pets
        INNER JOIN users ON users.id = pets.id_usuario
        WHERE pets.id_usuario = :id
        GROUP BY pets.nombre
    ', [":id"=>$id]);
        
    $user=user::find($id);

    if ($result != null && $user) {
        $pets_res = DB::select('SELECT pets.nombre as MyPets FROM pets
            INNER JOIN users ON users.id = pets.id_usuario
            WHERE pets.id_usuario = :id
        ', [":id"=>$id]);
    
        return response()->json(
            [
                'nombre'=>$user->nombre,
                'pets' => $pets_res],200);
    } else {
        return response()->json(
            [
                "nombre"=>$user->nombre,
                "msg" => "You don't have any registered pets!"
            ], 404);
        }
    }   


    public function store(Request $request)
    {
        // Validación de los datos antes de crear la mascota
        $validator = Validator::make($request->all(), [
            'nombre' => 'required|string',
            'peso' => 'required|string',
            'id_collar' => 'required|exists:collars,id',
            'id_usuario' => 'required|exists:users,id',
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
}
