<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    use HasFactory;

    protected $table = 't_category'; // Nom de la table
    protected $primaryKey = 'id_cat'; // Clé primaire

    // Champs modifiables
    protected $fillable = [
        'name_cat',
    ];
}
