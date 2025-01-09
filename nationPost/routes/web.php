<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\CategoryController;

/*
|---------------------------------------------------------------------------|
| Web Routes                                                                |
|---------------------------------------------------------------------------|
|
| Here is where you can register web routes for your application.
| These routes are loaded by the RouteServiceProvider and assigned to the "web" middleware group.
|
*/

// Route pour la page d'accueil (gère GET et POST)
Route::match(['get', 'post'], '/', function () {
    if (request()->isMethod('post')) {
        // Gérer les requêtes POST ici (si nécessaire)
        return response('Requête POST reçue');
    }
    return view('index'); // Si c'est une requête GET, afficher la vue "index"
});

// Route pour index.php qui gère aussi bien GET que POST
Route::match(['get', 'post'], '/index.php', function () {
    if (request()->isMethod('post')) {
        // Traite la requête POST ici
        return response('Requête POST reçue');
    }
    return view('index'); // Afficher la vue index pour GET
});

// Autres routes
Route::get('/article.php', fn() => view('article'));
Route::get('/recherche.php', fn() => view('recherche'));

// Connexion
Route::post('/login', [AuthController::class, 'login'])->name('login');
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

// Préférences
Route::post('/set-preferences', [AuthController::class, 'setPreferences'])->name('set.preferences');

// Catégories
Route::get('/category/{id}', [CategoryController::class, 'show'])->name('category.show');
