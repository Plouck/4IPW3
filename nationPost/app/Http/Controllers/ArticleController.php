<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Article; // N'oublie pas d'importer ton modèle Article si tu veux l'utiliser

class ArticleController extends Controller
{
    // Afficher la vue article (par exemple, une page d'affichage ou un formulaire)
    public function show()
    {
        return view('article');
    }

    // Traiter la requête POST (par exemple, enregistrer un article)
    public function store(Request $request)
    {
        // Validation des données du formulaire (optionnel)
        $validated = $request->validate([
            'title' => 'required|max:255',
            'content' => 'required',
        ]);

        // Logique pour enregistrer l'article dans la base de données
        // Si tu veux enregistrer un nouvel article, décommente cette ligne
        // Article::create($validated); 

        // Ou si tu souhaites enregistrer l'article de manière plus explicite :
        $article = new Article;
        $article->title_art = $validated['title'];
        $article->content_art = $validated['content'];
        $article->save();

        // Retourner une réponse
        return response('Article soumis avec succès', 200);
    }
}
