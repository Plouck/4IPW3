<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Article;
use App\Models\Category;

class SearchController extends Controller
{
    /**
     * Affiche la page de recherche avec les catégories et les dates disponibles.
     *
     * @return \Illuminate\View\View
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
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\View\View
     */
    public function search(Request $request)
    {
        // Valider les entrées du formulaire
        $validated = $request->validate([
            'title' => 'nullable|string|max:255',
            'category' => 'nullable|integer|exists:categories,id_cat',
            'date_range' => 'nullable|string|in:before_2020,2020_2023,after_2023',
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
}
