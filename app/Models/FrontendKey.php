<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class FrontendKey extends Model
{
    use HasFactory;
    protected $fillable = ['key'];

    // Tarjimalar
    public function translations()
    {
        return $this->hasMany(KeysTranslate::class, 'frontend_key_id');
    }

    // Tarjimalarni olish
    public function getTranslation($locale)
    {
        return $this->translations()->whereHas('language', function ($query) use ($locale) {
            $query->where('code', $locale);
        })->first();
    }
}
