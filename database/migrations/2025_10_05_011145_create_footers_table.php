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
        Schema::create('footers', function (Blueprint $table) {
            $table->id();
            $table->string('logo')->nullable();       // path logo
            $table->string('slogan')->nullable();     // tagline
            $table->text('deskripsi')->nullable();    // teks deskripsi
            $table->string('alamat')->nullable();     // alamat masjid/TPA
            $table->string('telepon')->nullable();
            $table->string('email')->nullable();
            $table->longText('map_embed')->nullable();    // iframe atau url google maps
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('footers');
    }
};
