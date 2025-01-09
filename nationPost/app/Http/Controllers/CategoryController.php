<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Category;
use App\Models\Article;

class CategoryController extends Controller
{
    public function show($id)
    {
        // Récupérer la catégorie par son ID
        $category = Category::findOrFail($id);

        // Récupérer les articles associés à cette catégorie
        $articles = Article::where('fk_category_art', $category->id_cat)->get();

        // Passer les données à la vue
        return view('categories.category', compact('category', 'articles'));
    }
}
