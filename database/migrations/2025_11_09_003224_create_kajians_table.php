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
            $table->string('judul'); // Judul kajian
            $table->text('materi'); // Materi kajian
            $table->string('pembicara'); // Nama ustadz/ustadzah
            $table->string('jenis_kajian'); // Jenis kajian
            $table->date('tanggal'); // Tanggal kajian
            $table->time('waktu_mulai')->nullable(); // Waktu mulai
            $table->time('waktu_selesai')->nullable(); // Waktu selesai
            $table->string('lokasi'); // Alamat/lokasi kajian
            $table->text('keterangan')->nullable(); // Keterangan tambahan
            $table->string('poster')->nullable(); // Nama file poster
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
