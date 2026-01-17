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
        Schema::create('teachers', function (Blueprint $table) {
            $table->id();
            $table->foreignId('school_id')->constrained()->onDelete('cascade');
            
            $table->string('name');
            $table->string('nip')->nullable(); // Nomor Induk Pegawai
            $table->string('position'); // Contoh: Guru Matematika, Wali Kelas, Staff TU
            $table->enum('type', ['guru', 'staf'])->default('guru');
            
            $table->string('photo')->nullable();
            $table->integer('order')->default(0); // Untuk mengatur urutan tampilan (Kepsek di atas)
            $table->boolean('is_active')->default(true);
            
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('teachers');
    }
};
