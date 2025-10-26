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
        Schema::create('histories', function (Blueprint $table) {
            $table->id();
            $table->string('title'); // Judul utama (misal: Sejarah TPA Al-Ikhlas)
            $table->string('subtitle')->nullable(); // Subjudul (misal: Awal Mula Berdirinya)
            $table->longText('content'); // Isi teks utama (HTML/teks panjang)
            $table->string('image')->nullable(); // Path gambar (opsional)
            $table->timestamps(); // created_at & updated_at
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('histories');
    }
};
