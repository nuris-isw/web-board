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
        Schema::create('ppdb_periods', function (Blueprint $table) {
            $table->id();
            $table->foreignId('ppdb_setting_id')->constrained()->onDelete('cascade');
            $table->enum('type', ['1', '2', '3', 'khusus'])->default('1');
            $table->string('name'); // Contoh: Gelombang 1 (Early Bird)
            $table->date('start_date');
            $table->date('end_date');
            $table->string('status_label')->nullable(); // Contoh: "Diskon 50% Infaq"
            $table->boolean('is_open')->default(true);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('ppdb_periods');
    }
};
