<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Article;
use Illuminate\Http\Request;

class SearchController extends Controller
{
    // Affiche la page de recherche (formulaire + zones de résultats)
    public function showSearchPage()
    {
        $categories = Category::all();
        return view('recherche', compact('categories'));
    }

    // Exécute la recherche et renvoie les résultats au format JSON
    public function searchAjax(Request $request)
    {
        $query = Article::with('category'); // Chargement de la relation category si nécessaire

        if ($request->filled('title')) {
            $query->where('title_art', 'like', '%' . $request->title . '%');
        }
        if ($request->filled('category')) {
            $query->where('fk_category_art', $request->category);
        }
        if ($request->filled('specific_date') && $request->specific_date !== 'Aucune') {
            $day = str_pad($request->specific_date, 2, '0', STR_PAD_LEFT);
            $dateFormatted = "2023-12-{$day}";
            $query->where('date_art', $dateFormatted);
        }
        if ($request->filled('keyword')) {
            $query->where('content_art', 'like', '%' . $request->keyword . '%');
        }
        if ($request->filled('readtime')) {
            $query->where('readtime_art', $request->readtime);
        }

        $articles = $query->get();

        return response()->json($articles);
    }
}
