<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Language extends Model
{
    use HasFactory;
    protected $fillable = [
        'code',
        'name',
        'is_default',
        'flag',
        'is_active',
        'rlt'
    ];

    // Aktiv tillarni olish
    public static function getActiveLanguages()
    {
        return self::where('is_active', true)->get();
    }

    // Standart tilni aniqlash
    public static function getDefaultLanguage()
    {
        return self::where('is_default', true)->first() ?? self::first();
    }

    // ❗️ YANGI: Mavjud tillar ro‘yxatini olish (faqat kodlari)
    public static function getAvailableLanguages()
    {
        return self::where('is_active', true)->pluck('code')->toArray();
    }


}
