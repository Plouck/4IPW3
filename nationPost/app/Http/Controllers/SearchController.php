<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Article;
use App\Models\Category;

class SearchController extends Controller
{
    /**
     * Affiche la page de recherche avec les catégories et les dates disponibles.
     */
    public function index()
    {
        // Récupérer toutes les catégories
        $categories = Category::all();

        // Récupérer toutes les dates distinctes des articles
        $dates = Article::select('date_art')->distinct()->orderBy('date_art', 'desc')->pluck('date_art');

        return view('recherche', compact('categories', 'dates'));
    }

    /**
     * Effectue une recherche en fonction des critères du formulaire.
     */
    public function search(Request $request)
    {
        // Valider les entrées du formulaire
        $validated = $request->validate([
            'title' => 'nullable|string|max:255',
            'category' => 'nullable|integer|exists:categories,id_cat',
            'specific_date' => 'nullable|date',
            'keyword' => 'nullable|string|max:255',
        ]);

        // Construire la requête
        $query = Article::query();

        // Filtrer par titre
        if (!empty($validated['title'])) {
            $query->where('title_art', 'like', "%" . $validated['title'] . "%");
        }

        // Filtrer par catégorie
        if (!empty($validated['category'])) {
            $query->where('fk_category_art', $validated['category']);
        }

        // Filtrer par date spécifique
        if (!empty($validated['specific_date'])) {
            $query->where('date_art', $validated['specific_date']);
        }

        // Filtrer par mot-clé
        if (!empty($validated['keyword'])) {
            $query->where(function ($q) use ($validated) {
                $q->where('hook_art', 'like', "%" . $validated['keyword'] . "%")
                  ->orWhere('content_art', 'like', "%" . $validated['keyword'] . "%");
            });
        }

        // Limiter les résultats à 10
        $articles = $query->take(10)->get();

        // Récupérer toutes les catégories pour le formulaire
        $categories = Category::all();

        // Récupérer toutes les dates distinctes des articles
        $dates = Article::select('date_art')->distinct()->orderBy('date_art', 'desc')->pluck('date_art');

        // Retourner les résultats, catégories, et dates à la vue
        return view('recherche', compact('articles', 'categories', 'dates'));
    }

    /**
     * Affiche la liste des dates distinctes des articles.
     */
    public function listDates()
    {
        // Récupérer toutes les dates distinctes des articles
        $dates = Article::select('date_art')
            ->distinct()
            ->orderBy('date_art', 'desc')
            ->get();

        return view('dates', compact('dates'));
    }

    /**
     * Affiche les articles pour une date spécifique.
     * Paramètre de route : {date_art}
     */
    public function articlesByDate($date_art)
    {
        // Récupérer les articles correspondant à la date
        $articles = Article::where('date_art', $date_art)
            ->take(10)
            ->get();

        // On renvoie 'date_art' à la vue pour l'afficher
        return view('articles_by_date', [
            'articles' => $articles,
            'date_art' => $date_art,
        ]);
    }
}
