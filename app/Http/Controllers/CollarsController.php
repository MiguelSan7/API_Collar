<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Collar;
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
}
