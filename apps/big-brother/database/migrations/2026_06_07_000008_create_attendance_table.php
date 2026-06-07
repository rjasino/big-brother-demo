<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('attendance', function (Blueprint $table) {
            $table->id();
            $table->foreignId('student_id')->constrained()->cascadeOnDelete()->cascadeOnUpdate();
            $table->foreignId('course_id')->constrained()->restrictOnDelete()->cascadeOnUpdate();
            $table->date('attendance_date');
            $table->string('attendance_status', 20);
            $table->text('remarks')->nullable();
            $table->timestamps();

            $table->unique(['student_id', 'course_id', 'attendance_date']);
            $table->index('attendance_date');
            $table->index('attendance_status');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('attendance');
    }
};
