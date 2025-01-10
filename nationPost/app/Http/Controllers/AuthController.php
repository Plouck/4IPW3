<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Hash; // Importation du Hash pour la sécurité

class AuthController extends Controller
{
    public function login(Request $request)
    {
        $credentials = $request->only('username', 'password');

        // Vérification simple de l'authentification (à remplacer par un système plus sécurisé)
        if ($credentials['username'] === 'admin' && $credentials['password'] === 'password') {
            session(['user' => $credentials]);
            return redirect('/')->with('message', 'Connexion réussie !');  // Changer ici pour la racine '/'
        }

        return back()->withErrors(['username' => 'Identifiants incorrects.']);
    }

    public function logout()
    {
        session()->forget('user'); // Suppression de l'utilisateur dans la session
        return redirect('/')->with('message', 'Déconnexion réussie !');  // Changer ici pour la racine '/'
    }

    public function setPreferences(Request $request)
    {
        // Validation des préférences avec des messages d'erreur personnalisés
        $validatedData = $request->validate([
            'theme' => 'in:light,dark,grey',
            'font_size' => 'in:small,medium,large',
        ], [
            'theme.in' => 'Le thème sélectionné n\'est pas valide.',
            'font_size.in' => 'La taille de police sélectionnée n\'est pas valide.',
        ]);

        // Mise à jour des préférences dans la session
        session([
            'theme' => $request->input('theme'),
            'font_size' => $request->input('font_size'),
        ]);

        // Redirection avec un message de succès
        return redirect('/')->with('message', 'Préférences mises à jour avec succès !');  // Changer ici pour la racine '/'
    }
    
}
