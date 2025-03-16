<?php 

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Article;
use Illuminate\Http\Request;

class SearchController extends Controller
{
    // Affiche le formulaire de recherche
    public function showSearchPage()
    {
        $categories = Category::all();
        return view('recherche', compact('categories'));
    }

    // Exécute la recherche et affiche directement les résultats
    public function search(Request $request)
    {
        $query = Article::with('category'); // ✅ Charger la relation "category"

        // Filtrage dynamique basé sur les entrées utilisateur
        if ($request->filled('title')) {
            $query->where('title_art', 'like', '%' . $request->title . '%');
        }
        if ($request->filled('category')) {
            $query->where('fk_category_art', $request->category);
        }
        if ($request->filled('specific_date') && $request->specific_date !== 'Aucune') {
            // Reformater la date du slider pour correspondre à `YYYY-MM-DD`
            $day = str_pad($request->specific_date, 2, '0', STR_PAD_LEFT);
            $dateFormatted = "2023-12-{$day}";  
            $query->where('date_art', $dateFormatted);
        }
        if ($request->filled('keyword')) {
            $query->where('content_art', 'like', '%' . $request->keyword . '%');
        }
        if ($request->filled('readtime')) {
            $query->where('readtime_art', $request->readtime); // Durée de lecture exacte
            // Optionnel : si tu veux faire un filtre plus large (ex: <= durée choisie) :
            // $query->where('readtime_art', '<=', $request->readtime);
        }

        // Récupération des articles correspondants avec leur catégorie
        $articles = $query->get();

        return view('searchResults', compact('articles'));
    }
}
