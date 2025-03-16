<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Laravel\Sanctum\HasApiTokens;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use HasApiTokens, Notifiable;

    protected $fillable = [
        'name', 'username', 'email', 'password', 'role',
    ];

    // Vérifier si l'utilisateur a un rôle spécifique
    public function hasRole($role)
    {
        return $this->role === $role;
    }

    // Vous pouvez aussi ajouter un accès plus rapide aux rôles
    public function isAdmin()
    {
        return $this->role === 'admin';
    }

    public function isUser()
    {
        return $this->role === 'user';
    }
}
