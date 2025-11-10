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
        Schema::create('kajians', function (Blueprint $table) {
            $table->id();
            $table->string('judul');
            $table->text('materi');
            $table->string('pembicara');
            $table->enum('jenis_kajian', ['pekanan', 'bulanan']); // Dua jenis saja
            $table->enum('hari', ['sabtu', 'ahad']); // Pilihan hari
            $table->time('waktu_mulai')->nullable(); // hanya diisi untuk bulanan
            $table->time('waktu_selesai')->nullable(); // hanya diisi untuk bulanan
            $table->string('lokasi')->nullable();
            $table->text('keterangan')->nullable();
            $table->string('poster')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('kajians');
    }
};
