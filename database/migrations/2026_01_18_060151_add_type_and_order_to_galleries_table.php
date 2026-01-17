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
        Schema::table('galleries', function (Blueprint $table) {
            $table->enum('type', ['slider', 'home', 'gallery'])
                  ->default('gallery')
                  ->after('image_path');

            // Menambahkan kolom order untuk mengatur urutan tampilan
            $table->integer('order')
                  ->default(0)
                  ->after('type');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('galleries', function (Blueprint $table) {
            //
        });
    }
};
