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
        Schema::table('artists', function (Blueprint $table) {
            $table->string('discogs_url')->nullable();
            $table->string('discogs_image_url')->nullable();
            $table->integer('discogs_id_manual')->nullable()->after('discogs_id');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('artists', function (Blueprint $table) {
            $table->dropColumn(['discogs_image_url', 'discogs_url', 'discogs_id_manual']);
        });
    }
};
