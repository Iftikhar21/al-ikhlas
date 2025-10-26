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
        Schema::create('ummi_levels', function (Blueprint $table) {
            $table->id();
            $table->string('name'); // nama level, contoh: Ummi 1, Ummi 2
            $table->text('description')->nullable(); // deskripsi singkat level
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('ummi_levels');
    }
};
