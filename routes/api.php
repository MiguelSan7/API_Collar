<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\AuthController;
use App\Http\Controllers\PetsController;
use App\http\Controllers\GuzzleController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::group(
    [
    'middleware' => 'api',
    'prefix' => 'auth',
    ],
    function ($router) {
        Route::post('register', [AuthController::class, 'register']);
        Route::post('login', [AuthController::class, 'login']);
        Route::post('logout', [AuthController::class, 'logout']);
        Route::get('me', [AuthController::class, 'me']);
        Route::get('/home/{id}',[AuthController::class,'Home']);
    }
);

Route::group(
    [
        'middleware' => 'api',
        'prefix' => 'pets',
    ],
    function ($router) {
        Route::get('/view', [PetsController::class, 'index']);
        Route::get('/view/{id}', [PetsController::class, 'show']);
        Route::post('/add', [PetsController::class, 'store']);
        Route::put('/edit/{id}', [PetsController::class, 'update']);
        Route::delete('/delete/{id}', [PetsController::class, 'destroy']);
        Route::get('/mypets/{id}',[PetsController::class,'MyPets']);
    }
);
Route::group([
    'middleware' => 'api',
    'prefix' => 'guzzle',

],
function ($router) {
    Route::post('/buzzer', [GuzzleController::class, 'controlarBuzzer']);
    Route::get('/view', [GuzzleController::class, 'apiHTTP']);
}
);
