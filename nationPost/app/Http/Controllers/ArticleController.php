<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Article;
use App\Models\Category;

class ArticleController extends Controller
{
    // Page d'accueil : Affichage des 10 derniers articles
    public function index()
    {
        $articles = Article::orderBy('date_art', 'desc')
            ->orderBy('id_art', 'desc')
            ->take(10)
            ->get();

        return view('index', compact('articles'));
    }

    // Affichage d'un article spécifique
    public function show($id)
    {
        $article = Article::findOrFail($id);
        $category = Category::find($article->fk_category_art);

        return view('article', compact('article', 'category'));
    }

    // Ajouter un article aux favoris
    public function addToFavorites($id)
    {
        $favorites = isset($_COOKIE['favorites']) ? json_decode($_COOKIE['favorites'], true) : [];

        if (!in_array($id, $favorites)) {
            $favorites[] = $id;
            setcookie('favorites', json_encode($favorites), time() + (86400 * 30), "/");
        }

        return redirect()->route('index')->with('message', 'Article ajouté aux favoris!');
    }

    // Afficher les articles favoris
    public function showFavorites()
    {
        $favorites = isset($_COOKIE['favorites']) ? json_decode($_COOKIE['favorites'], true) : [];
        $favoriteArticles = Article::whereIn('id_art', $favorites)->get();
        return view('favorites', compact('favoriteArticles'));
    }
}
