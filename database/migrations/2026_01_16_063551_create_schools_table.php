<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('schools', function (Blueprint $table) {
            $table->id();
            $table->string('uuid')->unique(); // Untuk keamanan identitas di API
            $table->string('name');
            $table->string('slug')->unique(); // Contoh: smpn1-jakarta
            $table->string('domain')->nullable()->unique(); // Untuk custom domain
            
            // Konfigurasi Tampilan
            $table->enum('theme_type', ['kindergarten', 'elementary', 'highschool'])->default('elementary');
            $table->json('appearance_settings'); 
            // Isi JSON: {"color_mode": "preset", "colors": {"primary": "#...", "secondary": "#...", "accent": "#...", "bg": "#..."}}
            
            $table->boolean('is_active')->default(true);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('schools');
    }
};
