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
        Schema::create('class_room_student', function (Blueprint $table) {
            $table->foreignId('class_room_id')->constrained()->onDelete('CASCADE');
            $table->foreignId('student_id')->constrained()->onDelete('CASCADE');
            $table->string('school_year');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('class_room_student');
    }
};
