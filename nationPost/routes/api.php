<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;

/*
|----------------------------------------------------------------------
| API Routes
|----------------------------------------------------------------------
|
| Here is where you can register API routes for your application.
| These routes are loaded by the RouteServiceProvider and all of them 
| will be assigned to the "api" middleware group. Make something great!
|
*/

// Route pour obtenir les informations de l'utilisateur authentifié
Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

// Route pour la connexion via l'API
Route::post('/login', [AuthController::class, 'apiLogin']);

// Route pour la déconnexion, accessible uniquement aux utilisateurs authentifiés
Route::post('/logout', [AuthController::class, 'logout'])->middleware('auth:sanctum');
