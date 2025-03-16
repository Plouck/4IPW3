<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\SearchController;
use App\Http\Controllers\ArticleController;

// Route de la page d'accueil
Route::get('/', [ArticleController::class, 'index'])->name('home');

// Route pour afficher un article spécifique
Route::get('/article/{id}', [ArticleController::class, 'show'])->name('article.show');

// Route pour soumettre un article
Route::post('/article', [ArticleController::class, 'store'])->name('article.store');

// Routes de gestion de l'authentification
Route::post('/login', [AuthController::class, 'login'])->name('login');
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

// Routes pour les catégories
Route::get('/category/{id}', [CategoryController::class, 'show'])->name('category.show');

// Routes de recherche
Route::get('/recherche', [SearchController::class, 'showSearchPage'])->name('search'); 
Route::post('/recherche', [SearchController::class, 'search'])->name('search'); 
Route::get('/recherche/resultats', [SearchController::class, 'searchResults'])->name('search.results');

// Routes pour gérer les articles favoris
Route::get('/favorites', [ArticleController::class, 'showFavorites'])->name('article.favorites');
Route::post('/article/{id}/favorite', [ArticleController::class, 'addFavorite'])->name('article.addFavorite');

// Route pour afficher l'index des articles
Route::get('/index', [ArticleController::class, 'index'])->name('index');

Route::post('/set-preferences', [AuthController::class, 'setPreferences'])->name('set.preferences');

