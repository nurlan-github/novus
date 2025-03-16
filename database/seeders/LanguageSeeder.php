<?php

namespace Database\Seeders;

use App\Models\Language;
use Illuminate\Database\Seeder;

class LanguageSeeder extends Seeder
{
    public function run(): void
    {
        $languages = [
            [
                'code' => 'uz',
                'name' => "O'zbekcha",
                'is_default' => true,
                'flag' => 'uz.png',
                'is_active' => true,
                'rlt' => false,
            ],
            // [
            //     'code' => 'kaa',
            //     'name' => "Qaraqalpaqsha",
            //     'is_default' => true,
            //     'flag' => 'kaa.png',
            //     'is_active' => true,
            //     'rlt' => false,
            // ],
            [
                'code' => 'ru',
                'name' => 'Русский',
                'is_default' => false,
                'flag' => 'ru.png',
                'is_active' => true,
                'rlt' => false,
            ],
            [
                'code' => 'en',
                'name' => 'English',
                'is_default' => false,
                'flag' => 'en.png',
                'is_active' => true,
                'rlt' => false,
            ],
        ];

        foreach ($languages as $lang) {
            Language::updateOrCreate(['code' => $lang['code']], $lang);
        }
    }
}
