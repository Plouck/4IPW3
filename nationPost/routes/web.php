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

// Route pour afficher un article spécifique
Route::get('/article/{id}', [ArticleController::class, 'show'])->name('article.show');

// Routes pour l'authentification
Route::get('/login', [AuthController::class, 'showLoginForm'])->name('login');
Route::post('/login', [AuthController::class, 'login'])->name('login.post');
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

// Routes pour l'inscription
Route::get('/register', [AuthController::class, 'showRegisterForm'])->name('register');
Route::post('/register', [AuthController::class, 'register'])->name('register.post');

// Routes pour les catégories
Route::get('/category/{id}', [CategoryController::class, 'show'])->name('category.show');

// Routes de recherche
Route::get('/recherche', [SearchController::class, 'showSearchPage'])->name('search');
Route::post('/recherche', [SearchController::class, 'search'])->name('search');
Route::get('/recherche/resultats', [SearchController::class, 'searchResults'])->name('search.results');

// Route pour afficher les articles d'une date spécifique
Route::get('/dates/{date_art}', [SearchController::class, 'articlesByDate'])->name('articlesByDate');

// Routes pour les favoris (stockés en session)
Route::get('/favorites', [ArticleController::class, 'showFavorites'])->name('favorites.show');
Route::post('/favorites/add/{id}', [ArticleController::class, 'addToFavorites'])->name('favorites.add');
Route::post('/favorites/remove/{id}', [ArticleController::class, 'removeFromFavorites'])->name('favorites.remove');
Route::post('/favorites/clear', [ArticleController::class, 'clearFavorites'])->name('favorites.clear');

// Route pour afficher les informations d'un article
Route::get('/article-info/{id}', [ArticleController::class, 'getArticleInfo']);

// Routes pour le tableau de bord (protégées par middleware)
Route::middleware(['auth', 'admin'])->group(function () {
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
});

// Préférences utilisateur
Route::post('/set-preferences', [AuthController::class, 'update'])->name('set.preferences');

Route::get('/favorites/count', [ArticleController::class, 'favoriteCount'])->name('favorites.count');
Route::post('/article/{id}/favorite', [ArticleController::class, 'addFavorite'])->name('article.addFavorite');

Route::get('/favorites/list', [ArticleController::class, 'favoriteList'])->name('favorites.list');
