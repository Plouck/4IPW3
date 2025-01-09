<?php

namespace App\Http\Controllers;

use App\Models\Article;
use Illuminate\Http\Request;
use Carbon\Carbon;

class DateController extends Controller
{
    /**
     * A) Afficher toutes les dates distinctes, classées du plus récent au plus ancien
     */
    public function showDates()
    {
        // On sélectionne la colonne date_art de façon distincte
        // et on trie par ordre décroissant
        $dates = Article::select('date_art')
                        ->distinct()
                        ->orderBy('date_art', 'desc')
                        ->get();

        // On renvoie la vue "dates.blade.php"
        // en lui passant la variable $dates
        return view('dates', compact('dates'));
    }

    /**
     * B) Afficher jusqu’à 10 articles ayant la date cliquée
     */
    public function showArticlesByDate($date_art)
    {
        // On récupère un maximum de 10 articles
        // dont la colonne "date_art" vaut la date reçue en paramètre
        $articles = Article::where('date_art', $date_art)
                           ->limit(10)
                           ->get();

        // On renvoie la vue "articles_by_date.blade.php"
        // avec la liste des articles + la date
        return view('articles_by_date', [
            'articles' => $articles,
            'date_art' => $date_art,
        ]);
    }
}
