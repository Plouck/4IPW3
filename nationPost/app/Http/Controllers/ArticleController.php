<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Article;

class ArticleController extends Controller
{
    // Afficher la liste des articles pour la page d'accueil (articles du 15 décembre 2023)
    public function index()
    {
        // Récupérer les 10 premiers articles publiés le 15 décembre 2023
        $articles = Article::where('date_art', '2023-12-15')
    ->orderBy('id_art', 'desc')  // Tri par id_art
    ->take(10)
    ->get();


        return view('index', compact('articles')); // Passe les articles à la vue index.blade.php
    }

    // Afficher un article spécifique en fonction de l'ID
    public function show($id)
{
    // Récupérer l'article par son ID
    $article = Article::findOrFail($id);
    
    // Passer l'article à la vue
    return view('article.show', compact('article'));
}

    // Traiter la soumission d'un nouvel article (si besoin)
    public function store(Request $request)
    {
        // Validation des données du formulaire
        $validated = $request->validate([
            'title' => 'required|max:255',
            'content' => 'required',
        ]);

        // Créer un nouvel article
        $article = new Article;
        $article->title_art = $validated['title'];
        $article->content_art = $validated['content'];
        $article->save();

        // Retourner une réponse
        return response('Article soumis avec succès', 200);
    }
}
