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
        Schema::create('extracurriculars', function (Blueprint $table) {
            $table->id();
            $table->foreignId('school_id')->constrained()->onDelete('cascade');
            
            $table->string('name'); // Nama Ekskul (misal: Pramuka, PMR)
            $table->string('slug')->unique();
            $table->string('coach')->nullable(); // Nama Pembina/Pelatih
            $table->text('description')->nullable();
            $table->string('image')->nullable(); // Foto kegiatan atau logo ekskul
            
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('extracurriculars');
    }
};
