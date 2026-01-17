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
        Schema::table('school_identities', function (Blueprint $table) {
            // Data Kepala Sekolah
            $table->string('headmaster_name')->after('welcome_message')->nullable();
            $table->string('headmaster_image')->after('headmaster_name')->nullable();
            
            // Data Akademik
            $table->text('curriculum')->after('mission')->nullable();
            
            // Lokasi (Untuk simpan kode Iframe)
            $table->text('google_maps')->after('social_media')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('school_identities', function (Blueprint $table) {
            $table->dropColumn(['headmaster_name', 'headmaster_image', 'curriculum', 'google_maps']);
        });
    }
};
