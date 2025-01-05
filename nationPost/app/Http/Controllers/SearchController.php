<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Article;
use App\Models\Category;

class SearchController extends Controller
{
    /**
     * Affiche la page de recherche avec les catégories disponibles.
     *
     * @return \Illuminate\View\View
     */
    public function index()
    {
        // Récupérer toutes les catégories pour les options du formulaire
        $categories = Category::all();

        return view('recherche', compact('categories'));
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
            'keyword' => 'nullable|string|max:255',
        ]);

        // Construire la requête de base
        $query = Article::query();

        // Filtrer par titre
        if (!empty($validated['title'])) {
            $query->where('title_art', 'like', "%" . $validated['title'] . "%");
        }

        // Filtrer par catégorie
        if (!empty($validated['category'])) {
            $query->where('fk_category_art', $validated['category']);
        }

        // Filtrer par plage de dates
        if (!empty($validated['date_range'])) {
            switch ($validated['date_range']) {
                case 'before_2020':
                    $query->whereYear('date_art', '<', 2020);
                    break;
                case '2020_2023':
                    $query->whereYear('date_art', '>=', 2020)
                          ->whereYear('date_art', '<=', 2023);
                    break;
                case 'after_2023':
                    $query->whereYear('date_art', '>', 2023);
                    break;
            }
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

        // Récupérer toutes les catégories pour les options du formulaire
        $categories = Category::all();

        // Retourner les résultats et les catégories à la vue
        return view('recherche', compact('articles', 'categories'));
    }
}
