<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class AuthController extends Controller
{
    /**
     * Affiche le formulaire de connexion.
     *
     * @return \Illuminate\View\View
     */
    public function showLoginForm()
    {
        return view('auth.login'); // Affiche la vue pour le formulaire de connexion
    }

    /**
     * Gère la connexion d'un utilisateur.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function login(Request $request)
    {
        $credentials = $request->only('username', 'password'); // Récupère les données de connexion

        // Charge les utilisateurs depuis un fichier de configuration
        $users = config('users'); 

        // Recherche si l'utilisateur existe avec les bonnes informations
        foreach ($users as $user) {
            if ($user['username'] === $credentials['username'] && $user['password'] === $credentials['password']) {
                // Si les informations sont correctes, l'utilisateur est stocké dans la session
                Session::put('user', $user);
                return redirect()->back(); // Redirige vers la page précédente
            }
        }

        // Si les identifiants sont incorrects, renvoie une erreur
        return back()->withErrors(['username' => 'Les identifiants sont incorrects.']);
    }

    /**
     * Gère la déconnexion d'un utilisateur.
     *
     * @return \Illuminate\Http\RedirectResponse
     */
    public function logout()
    {
        Session::forget('user'); // Supprime l'utilisateur de la session
        return redirect()->back(); // Retourne à la page précédente après déconnexion
    }

    /**
     * Gère la mise à jour des préférences de l'utilisateur.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function setPreferences(Request $request)
    {
        // Stocke les préférences du thème et de la police dans la session
        Session::put('theme', $request->input('theme'));
        Session::put('font_size', $request->input('font_size'));

        return redirect()->back(); // Retourne à la page précédente
    }

    /**
     * Récupère les préférences de l'utilisateur (thème et taille de police).
     *
     * @return \Illuminate\View\View
     */
    public function getPreferences()
    {
        // Récupère les préférences stockées dans la session, avec des valeurs par défaut
        $theme = session('theme', 'light'); // Valeur par défaut 'light'
        $font_size = session('font_size', 'medium'); // Valeur par défaut 'medium'

        // Passe ces préférences à la vue
        return view('index', compact('theme', 'font_size'));
    }
}
