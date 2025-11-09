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
        Schema::create('koperasi_activity_photo', function (Blueprint $table) {
            $table->id();
            $table->foreignId('koperasi_activity_id')
                ->constrained('koperasi_activity') // <-- tulis nama tabel secara manual
                ->onDelete('cascade');
            $table->string('path');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('koperasi_activity_photo');
    }
};
