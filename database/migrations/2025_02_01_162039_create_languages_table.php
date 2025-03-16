<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('languages', function (Blueprint $table) {
            $table->id();
            $table->string('code');              // 'uz', 'ru', 'en', etc.
            $table->string('name');              // O'zbekcha, Ruscha, Inglizcha
            $table->boolean('is_default')->default(false); // Default til
            $table->string('flag')->nullable();  // Flag icon
            $table->boolean('is_active')->default(true);   // Aktiv yoki yo‘q
            $table->boolean('rlt')->default(false);        // O‘ngdan chapga yozuv (RTL)
            $table->timestamps();
        });
        
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('languages');
    }
};
