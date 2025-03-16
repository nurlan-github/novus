<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CategoryTranslation extends Model
{
    use HasFactory;

    protected $fillable = [
        'category_id',
        'language_id',
        'name',
        'slug',
        'description',
    ];

    // Get the category for the translation
    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    // Get the language for the translation
    public function language()
    {
        return $this->belongsTo(Language::class);
    }
}