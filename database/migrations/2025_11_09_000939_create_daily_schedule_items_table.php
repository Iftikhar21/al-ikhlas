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
        Schema::create('daily_schedule_items', function (Blueprint $table) {
            $table->id();
            $table->foreignId('weekly_schedule_id')
                ->constrained('weekly_schedules') // Specify the table name explicitly
                ->onDelete('cascade');
            $table->foreignId('ummi_level_id')
                ->constrained('ummi_levels') // Specify the table name explicitly
                ->onDelete('cascade');
            $table->time('start_time');
            $table->time('end_time');
            $table->string('activity');
            $table->foreignId('teacher_id')
                ->constrained('teachers') // Specify the table name explicitly
                ->onDelete('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('daily_schedule_items');
    }
};
