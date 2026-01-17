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
        Schema::create('achievements', function (Blueprint $table) {
            $table->id();
            $table->foreignId('school_id')->constrained()->onDelete('cascade');
            
            // Jenis: 'siswa', 'guru', atau 'sekolah'
            $table->enum('achievement_type', ['siswa', 'guru', 'sekolah'])->default('siswa');
            
            $table->string('title'); // Contoh: Juara 1 Lomba Karya Ilmiah
            $table->string('winner_name')->nullable(); // Nama Siswa/Guru (kosongkan jika tipe 'sekolah')
            $table->string('competition_name')->nullable(); // Nama Ajang/Kompetisi
            
            $table->enum('level', ['kecamatan', 'kabupaten', 'provinsi', 'nasional', 'internasional']);
            $table->year('year');
            $table->text('description')->nullable();
            $table->string('image')->nullable();
            
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('achievements');
    }
};
