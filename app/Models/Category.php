<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    use HasFactory;

    protected $fillable = [
        'parent_id',
        'is_active',
    ];

    // Get the children categories
    public function children()
    {
        return $this->hasMany(Category::class, 'parent_id');
    }

    // Get the parent category
    public function parent()
    {
        return $this->belongsTo(Category::class, 'parent_id');
    }

    // Get the translations for the category
    public function translations()
    {
        return $this->hasMany(CategoryTranslation::class);
    }

    // Get the translation for a specific locale
    public function getTranslation($locale)
    {
        return $this->translations()->whereHas('language', function ($query) use ($locale) {
            $query->where('code', $locale);
        })->first();
    }
}