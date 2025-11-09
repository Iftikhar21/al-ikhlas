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
        Schema::create('koperasi_activity', function (Blueprint $table) {
            $table->id();
            $table->string('title'); // judul
            $table->string('slug')->unique(); // url slug
            $table->text('content'); // isi berita
            $table->string('thumbnail')->nullable(); // gambar utama
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('koperasi_activity');
    }
};
