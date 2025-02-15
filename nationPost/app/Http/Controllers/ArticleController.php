<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Article;

class ArticleController extends Controller
{
    // Afficher la liste des articles (page d'accueil)
    public function index()
    {
        // Récupérer les 10 premiers articles publiés le 15 décembre 2023
        $articles = Article::where('date_art', '2023-12-15')
    ->orderBy('id_art', 'desc')  // Tri par id_art
    ->take(10)
    ->get();


        return view('index', compact('articles')); // Passe les articles à la vue index.blade.php
    }


    // Afficher un article spécifique
    public function show($id)
    {
        $article = Article::findOrFail($id);
        return view('article', compact('article'));
    }

    // Ajouter un article aux favoris (cookie)
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
    public function addFavorite($id)
{
    // Récupérer l'article par ID
    $article = Article::findOrFail($id);

    // Vérifier si le cookie existe déjà, sinon le créer
    $favorites = isset($_COOKIE['favorites']) ? json_decode($_COOKIE['favorites'], true) : [];

    // Ajouter l'article aux favoris s'il n'y est pas déjà
    if (!in_array($article->id_art, $favorites)) {
        $favorites[] = $article->id_art;  // Ajouter l'ID de l'article aux favoris
    }

    // Enregistrer les favoris dans le cookie
    setcookie('favorites', json_encode($favorites), time() + (86400 * 30), '/'); // Cookie valable pendant 30 jours

    // Rediriger vers la page précédente ou afficher un message
    return redirect()->back()->with('success', 'Article ajouté aux favoris !');
}

}
