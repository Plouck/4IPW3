<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Article;
use App\Models\Category;

class ArticleController extends Controller
{
    // Afficher la liste des articles (page d'accueil)
    public function index()
    {
        $articles = Article::where('date_art', '2023-12-15')
            ->orderBy('id_art', 'desc')
            ->take(10)
            ->get();

        $categories = Category::all();

        return view('index', compact('articles', 'categories'));
    }

    // Afficher un article spécifique
    public function show($id)
    {
        $article = Article::findOrFail($id);
        return view('article', compact('article'));
    }

    public function addToFavorites(Request $request, $id)
    {
        $favorites = $request->session()->get('favorites', []);

        if (!in_array($id, $favorites)) {
            $favorites[] = $id;
            $request->session()->put('favorites', $favorites);
        }

        return redirect()->back()->with('message', 'Article ajouté aux favoris!');
    }

    // Retirer un article des favoris (session)
    public function removeFromFavorites(Request $request, $id)
    {
        $favorites = $request->session()->get('favorites', []);

        if (($key = array_search($id, $favorites)) !== false) {
            unset($favorites[$key]);
            $request->session()->put('favorites', array_values($favorites));
        }

        return redirect()->back()->with('message', 'Article retiré des favoris.');
    }

    // Effacer tous les favoris (session)
    public function clearFavorites(Request $request)
    {
        $request->session()->forget('favorites');
        return response()->json(['success' => true]);
    }

    // Afficher les articles favoris (session)
    public function showFavorites(Request $request)
    {
        $favorites = $request->session()->get('favorites', []);
        $favoriteArticles = Article::whereIn('id_art', $favorites)->get();
        $categories = Category::all();

        return view('favorites', compact('favoriteArticles', 'categories'));
    }

    // Récupérer les informations supplémentaires sur un article pour AJAX
    public function getArticleInfo($id)
    {
        $article = Article::findOrFail($id);
        return response()->json($article);
    }

    // Compte le nombre d'articles favoris
    public function favoriteCount(Request $request)
    {
        $favorites = $request->session()->get('favorites', []); // Récupérer les favoris depuis la session
        return response()->json(['count' => count($favorites)]);
    }

    public function favoriteList(Request $request)
    {
        $page = $request->input('page', 1);  // Récupère la page (par défaut la page 1)
        $size = $request->input('size', 5);   // Récupère la taille de la page (par défaut 5 articles par page)

        $favorites = $request->session()->get('favorites', []);
        $totalFavorites = count($favorites);  // Total des favoris

        $favoriteArticles = Article::whereIn('id_art', $favorites)
                                ->skip(($page - 1) * $size)
                                ->take($size)
                                ->get(['id_art', 'title_art', 'image_art']);

        return response()->json([
            'total' => $totalFavorites,  // Nombre total de favoris
            'favorites' => $favoriteArticles
        ]);
    }

}
