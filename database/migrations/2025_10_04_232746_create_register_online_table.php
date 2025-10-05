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
        Schema::create('register_online', function (Blueprint $table) {
            $table->id();
            $table->string('full_name');
            $table->string('gender');
            $table->string('birth_place');
            $table->date('birth_date');
            $table->text('address');
            $table->string('father_name');
            $table->string('father_occupation')->nullable();
            $table->string('mother_name');
            $table->string('mother_occupation')->nullable();
            $table->string('parent_phone');
            $table->string('parent_email')->nullable();
            $table->boolean('is_approved')->default(false);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('register_online');
    }
};
