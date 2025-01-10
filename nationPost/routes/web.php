<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\SearchController;

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

// Page recherche.html (redirigée vers recherche.blade.php)
Route::get('/recherche', [SearchController::class, 'index'])->name('recherche');

// Route pour effectuer la recherche
Route::get('/search', [SearchController::class, 'search'])->name('search');

/**
 * Route pour afficher la liste des dates distinctes 
 * (ex: /dates) -> renvoie la vue qui liste les dates.
 */
Route::get('/dates', [SearchController::class, 'listDates'])->name('listDates');

/**
 * Route pour afficher les articles d'une date spécifique
 * (ex: /dates/2023-12-31) -> renvoie la vue qui affiche 
 * les 10 articles de cette date.
 */
Route::get('/dates/{date_art}', [SearchController::class, 'articlesByDate'])
     ->name('articlesByDate');
