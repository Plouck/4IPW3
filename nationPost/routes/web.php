<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\SearchController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

// Page d'accueil
Route::get('/', function () {
    return view('index');
})->name('home');

// Page index.html (redirigée vers index.blade.php)
Route::get('/index.html', function () {
    return view('index');
})->name('index');

// Page article.html (redirigée vers article.blade.php)
Route::get('/article.html', function () {
    return view('article');
})->name('article');

// Page recherche.html (redirigée vers recherche.blade.php)
Route::get('/recherche', [SearchController::class, 'index'])->name('recherche');

// Route pour effectuer la recherche
Route::get('/search', [SearchController::class, 'search'])->name('search');
