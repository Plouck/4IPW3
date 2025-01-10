<?php 

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Article extends Model
{
    use HasFactory;

    // Nom de la table
    protected $table = 't_article';

    // Clé primaire
    protected $primaryKey = 'id_art';

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

    /**
     * Relation : un Article appartient à une Category
     * (fk_category_art dans t_article pointe sur id_cat dans t_category)
     */
    public function category()
    {
        return $this->belongsTo(Category::class, 'fk_category_art', 'id_cat');
    }
}
