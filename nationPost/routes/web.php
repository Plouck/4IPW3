<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\SearchController;
use App\Http\Controllers\ArticleController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\Auth\RegisteredUserController;

// Route de la page d'accueil
Route::get('/', [ArticleController::class, 'index'])->name('home');

// Route pour afficher un article spécifique (page complète, si besoin)
Route::get('/article/{id}', [ArticleController::class, 'show'])->name('article.show');

// Route pour soumettre un article
Route::post('/article', [ArticleController::class, 'store'])->name('article.store');

// Routes pour la connexion et l'inscription
Route::get('/login', [AuthController::class, 'showLoginForm'])->name('login'); // Formulaire de connexion
Route::post('/login', [AuthController::class, 'login'])->name('login.post');   // Traitement du formulaire de connexion

Route::get('/register', [AuthController::class, 'showRegisterForm'])->name('register');   // Formulaire d'inscription
Route::post('/register', [AuthController::class, 'register'])->name('register.post');     // Traitement du formulaire d'inscription

// Route de déconnexion (POST uniquement)
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

// Routes pour les catégories
Route::get('/category/{id}', [CategoryController::class, 'show'])->name('category.show');


// ========= Routes de recherche en mode SPA =========

// Affichage de la page de recherche (formulaire + zones dynamiques)
Route::get('/recherche', [SearchController::class, 'showSearchPage'])->name('search');

// Route AJAX pour exécuter la recherche et renvoyer les résultats en JSON
Route::get('/search-ajax', [SearchController::class, 'searchAjax'])->name('search.ajax');

// Route AJAX pour afficher les informations d'un article (pour l'affichage dynamique)
Route::get('/article-info/{id}', [ArticleController::class, 'getArticleInfo'])->name('article.info');

// Route pour la page "À propos"
Route::get('/apropos', function () {
    return view('apropos'); // On renvoie une vue "apropos.blade.php"
})->name('apropos');

// Routes pour gérer les articles favoris
Route::get('/favorites', [ArticleController::class, 'showFavorites'])->name('article.favorites');
Route::post('/article/{id}/favorite', [ArticleController::class, 'addFavorite'])->name('article.addFavorite');

// Route pour afficher les articles d'une date spécifique
Route::get('/dates/{date_art}', [SearchController::class, 'articlesByDate'])->name('articlesByDate');

// Routes pour le tableau de bord
Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

Route::middleware(['auth', 'admin'])->group(function () {
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
});
Route::get('/dashboard', [DashboardController::class, 'dashboard'])->middleware('auth');

// Route pour mettre à jour les préférences
Route::post('/set-preferences', [AuthController::class, 'update'])->name('set.preferences');


// ========= Routes pour l'inscription avec RegisteredUserController =========
Route::get('/register-alt', [RegisteredUserController::class, 'create'])->name('register.alt');
// La route GET ci-dessus affiche un autre formulaire d'inscription (alternatif).
// Tu peux renommer l'URL en /register si tu préfères unifier.

// La route POST ci-dessous appelle la méthode store() du RegisteredUserController
Route::post('/register-alt', [RegisteredUserController::class, 'store'])->name('register.store');
