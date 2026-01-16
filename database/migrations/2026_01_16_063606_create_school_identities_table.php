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
        Schema::create('school_identities', function (Blueprint $table) {
            $table->id();
            $table->foreignId('school_id')->constrained()->onDelete('cascade');
            $table->string('logo')->nullable();
            $table->text('welcome_message')->nullable(); // Sambutan Kepsek
            $table->text('history')->nullable();
            $table->text('vision');
            $table->text('mission');
            $table->string('address');
            $table->string('email');
            $table->string('phone');
            $table->json('social_media')->nullable(); // Instagram, FB, Youtube
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('school_identities');
    }
};
