<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class KeysTranslate extends Model
{
    use HasFactory;

    protected $fillable = ['frontend_key_id', 'language_id', 'value'];

    public function key()
    {
        return $this->belongsTo(FrontendKey::class, 'frontend_key_id');
    }

    public function language()
    {
        return $this->belongsTo(Language::class);
    }
}
