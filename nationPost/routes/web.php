<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\SearchController;
use App\Http\Controllers\ArticleController;

/*
|---------------------------------------------------------------------------|
| Web Routes                                                                |
|---------------------------------------------------------------------------|
| Ici, vous pouvez enregistrer les routes web pour votre application.      |
| Ces routes sont chargées par le RouteServiceProvider et assignées au     |
| groupe de middleware "web".                                               |
*/

Route::match(['get', 'post'], '/index', function () {
    return view('index'); // Page d'accueil
})->name('index');


// Route pour afficher la page article
Route::get('/article', [ArticleController::class, 'show'])->name('article.show');

// Route POST pour traiter la soumission d'un article
Route::post('/article', [ArticleController::class, 'store'])->name('article.store');

// Route de connexion
Route::post('/login', [AuthController::class, 'login'])->name('login');
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

// Route pour gérer les préférences (thème, taille de police)
Route::post('/set-preferences', [AuthController::class, 'setPreferences'])->name('set.preferences');

// Route pour afficher les articles par catégorie
Route::get('/category/{id}', [CategoryController::class, 'show'])->name('category.show');

// Route de recherche
Route::get('/recherche', [SearchController::class, 'showSearchPage'])->name('search');
Route::get('/recherche/resultats', [SearchController::class, 'search'])->name('search');
Route::match(['get', 'post'], '/recherche', [SearchController::class, 'search'])->name('search');
// Route pour afficher les dates distinctes
Route::get('/dates', [SearchController::class, 'listDates'])->name('listDates');

// Route pour afficher les articles d'une date spécifique
Route::get('/dates/{date_art}', [SearchController::class, 'articlesByDate'])
     ->name('articlesByDate');
