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
        Schema::create('footer_socials', function (Blueprint $table) {
            $table->id();
            $table->foreignId('footer_id')->constrained()->onDelete('cascade');
            $table->string('platform'); // Facebook, Instagram, WhatsApp, dll
            $table->string('url');      // link sosmed
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('footer_socials');
    }
};
