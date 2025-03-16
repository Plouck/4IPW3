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

// Route pour soumettre un article
Route::post('/article', [ArticleController::class, 'store'])->name('article.store');

// Routes pour la connexion et l'inscription
Route::get('/login', [AuthController::class, 'showLoginForm'])->name('login'); // Formulaire de connexion
Route::post('/login', [AuthController::class, 'login'])->name('login.post'); // Traitement du formulaire de connexion

Route::get('/register', [AuthController::class, 'showRegisterForm'])->name('register'); // Formulaire d'inscription
Route::post('/register', [AuthController::class, 'register'])->name('register.post'); // Traitement du formulaire d'inscription

// Route de déconnexion (POST uniquement)
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

// Route pour afficher les articles d'une date spécifique
Route::get('/dates/{date_art}', [SearchController::class, 'articlesByDate'])->name('articlesByDate');

// Route pour afficher les articles favoris
Route::get('/favorites', [ArticleController::class, 'showFavorites'])->name('article.favorites');

// Route pour ajouter un article aux favoris
Route::post('/article/{id}/favorite', [ArticleController::class, 'addFavorite'])->name('article.addFavorite');

// Route pour le tableau de bord
Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

// Route pour afficher les informations d'un article
Route::get('/article-info/{id}', [ArticleController::class, 'getArticleInfo']);

// Routes pour l'inscription avec RegisteredUserController
Route::get('/register', [RegisteredUserController::class, 'create'])->name('register');
Route::post('/register', [RegisteredUserController::class, 'store']); 

Route::middleware(['auth', 'admin'])->group(function () {
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
});

Route::get('/dashboard', [DashboardController::class, 'dashboard'])->middleware('auth');

Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

Route::post('/set-preferences', [AuthController::class, 'update'])->name('set.preferences');
