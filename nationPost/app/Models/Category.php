<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    use HasFactory;

    // Nom de la table
    protected $table = 't_category';

    // Clé primaire
    protected $primaryKey = 'id_cat';

    // Champs modifiables
    protected $fillable = [
        'name_cat',
    ];

    /**
     * Relation : une Category possède plusieurs Articles
     * (id_cat dans t_category est référencé par fk_category_art dans t_article)
     */
    public function articles()
    {
        return $this->hasMany(Article::class, 'fk_category_art', 'id_cat');
    }
}
