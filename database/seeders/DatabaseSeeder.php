<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        $this->call(LanguageSeeder::class);
        $this->call(RolePermissionSeeder::class);
        $this->call(FrontendKeySeeder::class);
        $this->call(CategorySeeder::class);
    }
}
