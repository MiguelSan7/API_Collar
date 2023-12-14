<?php

use App\Http\Controllers\CollarsController;
use App\Http\Controllers\PetsController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\AuthController;
use App\Http\Controllers\GuzzleController;

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


Route::post('/register', [AuthController::class, 'register']);
Route::post('/login', [AuthController::class, 'login']);
Route::get('/profile/{id}',[AuthController::class,'Profile']);

Route::post('/add', [PetsController::class, 'store']);
Route::get('/mypets/{id}',[PetsController::class,'MyPets']);

Route::get('guzzle/view', [GuzzleController::class, 'apiHTTP']);
