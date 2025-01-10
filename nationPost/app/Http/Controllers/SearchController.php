<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Article;
use Illuminate\Http\Request;

class SearchController extends Controller
{
    public function search(Request $request)
    {
        // Récupérer toutes les catégories et dates distinctes pour le formulaire de recherche
        $categories = Category::all();  
        $dates = Article::select('date_art')->distinct()->orderBy('date_art', 'desc')->pluck('date_art');
        
        // Si c'est une requête POST, effectuer la recherche
        if ($request->isMethod('post')) {
            $title = $request->get('title');
            $category = $request->get('category');
            $specific_date = $request->get('specific_date');
            $keyword = $request->get('keyword');

            $query = Article::query();

            if ($title) {
                $query->where('title_art', 'like', '%' . $title . '%');
            }

            if ($category) {
                $query->where('fk_category_art', $category);
            }

            if ($specific_date) {
                $query->where('date_art', $specific_date);
            }

            if ($keyword) {
                $query->where('content_art', 'like', '%' . $keyword . '%');
            }

            // Récupérer les articles correspondant à la recherche
            $articles = $query->get();

            // Retourner les résultats de recherche à la vue
            return view('recherche', compact('articles', 'categories', 'dates'));
        }

        // Si la méthode est GET, afficher le formulaire de recherche sans résultats
        return view('recherche', compact('categories', 'dates'));
    }
}
