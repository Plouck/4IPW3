<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use App\Models\User;

class AuthController extends Controller
{
    // Afficher le formulaire d'inscription
    public function showRegisterForm()
    {
        return view('auth.register');
    }

    // Inscription de l'utilisateur
    public function register(Request $request)
    {
        $validatedData = $request->validate([
            'name' => 'required|string|max:255',
            'username' => 'required|string|max:255|unique:users,username',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|string|confirmed|min:8',
        ]);

        // Définir un rôle (par défaut 'user')
        $role = $request->input('role', 'user');

        // Création de l'utilisateur
        $user = User::create([
            'name' => $validatedData['name'],
            'username' => $validatedData['username'],
            'email' => $validatedData['email'],
            'password' => Hash::make($validatedData['password']),
            'role' => $role,
        ]);

        // Connexion automatique après l'inscription
        Auth::login($user);

        // Redirection vers la page d'accueil avec un message de succès
        return redirect('/')->with('message', 'Inscription réussie !');
    }

    // Afficher le formulaire de connexion
    public function showLoginForm()
    {
        return view('auth.login');
    }

    // Connexion utilisateur (Web)
    public function login(Request $request)
    {
        // Récupération des données du formulaire
        $credentials = $request->only('username', 'password');

        // Tentative de connexion avec le 'username' et le 'password'
        if (Auth::attempt(['username' => $credentials['username'], 'password' => $credentials['password']])) {
            return redirect('/')->with('message', 'Connexion réussie !');
        }

        return back()->withErrors(['username' => 'Identifiants incorrects.']);
    }

    // Déconnexion (Web)
    public function logout()
    {
        Auth::logout();
        session()->flush();
        return redirect('/')->with('message', 'Déconnexion réussie !');
    }

    // Connexion via API
    public function apiLogin(Request $request)
    {
        // Validation des données de connexion
        $credentials = $request->validate([
            'email' => 'required|email',
            'password' => 'required'
        ]);

        // Tentative de connexion avec les informations
        if (!Auth::attempt($credentials)) {
            return response()->json(['message' => 'Identifiants incorrects'], 401);
        }

        // Génération du token si la connexion réussit
        $user = Auth::user();
        $token = $user->createToken('auth_token')->plainTextToken;

        return response()->json([
            'token' => $token,
            'user' => $user
        ], 200);
    }

    // Déconnexion via API
    public function apiLogout(Request $request)
    {
        // Suppression de tous les tokens liés à l'utilisateur
        $request->user()->tokens()->delete();
        return response()->json(['message' => 'Déconnexion réussie'], 200);
    }
    
    public function setPreferences(Request $request)
    {
        // Validation des préférences
        $validated = $request->validate([
            'theme' => 'nullable|string|in:default,light,dark,grey,yellow,rose,blue',
            'font_size' => 'nullable|string|in:default,small,medium,large',
            'font_family' => 'nullable|string|in:default,arial,times,courier',
        ]);

        // Enregistrement des préférences dans la session
        session([
            'theme' => $validated['theme'] === 'default' ? 'default' : $validated['theme'],
            'font_size' => $validated['font_size'] === 'default' ? 'default' : $validated['font_size'],
            'font_family' => $validated['font_family'] === 'default' ? 'default' : $validated['font_family'],
        ]);

        //dd(session()->all()); // Cette ligne affiche tout le contenu de la session

        // Retour avec un message de succès
        return back()->with('message', 'Préférences mises à jour.');
    }

    public function update(Request $request)
    {
        session([
            'theme' => $request->input('theme', 'default'),
            'font_size' => $request->input('font_size', 'default'),
            'font_family' => $request->input('font_family', 'default'),
        ]);

        return back();
    }

}
