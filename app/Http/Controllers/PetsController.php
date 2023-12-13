<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class PetsController extends Controller
{
    public function MyPets(Request $request, int $id)
    {
        $result = DB::select('
        SELECT count(pets.nombre) as "MyPets"
        FROM pets
        INNER JOIN users ON users.id = pets.id_usuario
        WHERE pets.id_usuario = :id
        GROUP BY pets.nombre
    ', [":id"=>$id]);
    $nombre=DB::selectOne('SELECT users.nombre from users WHERE users.id= :id ',
    [":id"=>$id]);
    
    if ($result != null) {
        $pets_res = DB::select('SELECT pets.nombre as MyPets FROM pets
            INNER JOIN users ON users.id = pets.id_usuario
            WHERE pets.id_usuario = :id
        ', [":id"=>$id]);
    
        return response()->json([
                'nombre'=>$nombre,
                'pets' => $pets_res],200);
    } else {
        return response()->json(
            [
                "nombre"=>$nombre,
                "msg" => "You don't have any registered pets!"
            ], 404);
        }
    }   
}
