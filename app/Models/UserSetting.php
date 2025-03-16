<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserSetting extends Model
{
    use HasFactory;
    protected $fillable = [
        'key',
        'value',
    ];

    // // Polymorphic relationship
    // public function settable()
    // {
    //     return $this->morphTo();
    // }
}
