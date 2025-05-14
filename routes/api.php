<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\PokemonController;
use App\Http\Controllers\AuthController;
use GuzzleHttp\Promise\Is;
use App\Http\Middleware\IsAdminAuth;
use App\Http\Middleware\IsUserAuth;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');



// Rutas de la API ---------------------------------------

//Devuelve todos los Pokemons
Route::get('/pokemon', [PokemonController::class, 'index']);

//Devuelve un Pokemon por ID
Route::get('/pokemon/{id}', [PokemonController::class, 'show']);

//Crea un Pokemon
Route::post('/pokemon', [PokemonController::class, 'store']);

//Actualiza un Pokemon
Route::put('/pokemon/{id}', [PokemonController::class, 'update']);

//Elimina un Pokemon
Route::delete('/pokemon/{id}', [PokemonController::class, 'destroy']);

//Actualiza parcialmente un Pokemon
Route::patch('/pokemon/{id}', [PokemonController::class, 'updatePartial']);

//PUBLIC ROUTES
Route::post('register', [AuthController::class, 'register']);
Route::post('login', [AuthController::class, 'login']);
Route::get('/pokemon', [PokemonController::class, 'index']);
Route::get('/pokemon/{id}', [PokemonController::class, 'show']);



//PROTECTED ROUTES
Route::middleware([IsUserAuth::class])->group(function () {
    Route::get('me', [AuthController::class, 'getUser']);
    Route::post('/logout', [AuthController::class, 'logout']);
    Route::post('/pokemon', [PokemonController::class, 'store']);
});

//ADMIN ROUTES
Route::middleware(\App\Http\Middleware\IsAdmin::class)->group(function () {
    Route::post('/pokemon', [PokemonController::class, 'store']);
    Route::put('/pokemon/{id}', [PokemonController::class, 'update']);
    Route::delete('/pokemon/{id}', [PokemonController::class, 'destroy']);
    Route::patch('/pokemon/{id}', [PokemonController::class, 'updatePartial']);
});


?>






