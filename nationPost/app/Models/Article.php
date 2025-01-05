<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Article extends Model
{
    use HasFactory;

    protected $table = 't_article'; // Nom de la table
    protected $primaryKey = 'id_art'; // Clé primaire

    // Champs modifiables
    protected $fillable = [
        'date_art',
        'readtime_art',
        'title_art',
        'hook_art',
        'url_art',
        'fk_category_art',
        'content_art',
        'image_art'
    ];
}
