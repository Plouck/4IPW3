<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Category;

class DashboardController extends Controller
{
    public function __construct()
    {
        $this->middleware('admin'); // Restreindre l'accès aux admins
    }

    public function index()
    {
        // Récupérer toutes les catégories pour la navbar
        $categories = Category::all();  

        return view('dashboard', compact('categories'));  
    }
}
