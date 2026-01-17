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
        Schema::create('ppdb_settings', function (Blueprint $table) {
            $table->id();
            $table->foreignId('school_id')->constrained()->onDelete('cascade');
            $table->string('academic_year'); // Contoh: 2026/2027
            $table->string('brochure_image')->nullable();
            $table->string('contact_whatsapp')->nullable();
            $table->string('registration_link')->nullable(); // Link ke sistem eksternal jika ada
            $table->text('description')->nullable(); // Penjelasan singkat prosedur
            $table->boolean('is_active')->default(false);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('ppdb_settings');
    }
};
