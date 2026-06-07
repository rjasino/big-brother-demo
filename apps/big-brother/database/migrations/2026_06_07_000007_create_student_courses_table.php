<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('student_courses', function (Blueprint $table) {
            $table->id();
            $table->foreignId('student_id')->constrained()->cascadeOnDelete()->cascadeOnUpdate();
            $table->foreignId('course_id')->constrained()->restrictOnDelete()->cascadeOnUpdate();
            $table->string('academic_year', 20);
            $table->string('term', 20);
            $table->string('enrollment_status', 20)->default('enrolled');
            $table->timestamp('enrolled_at');
            $table->timestamps();

            $table->unique(['student_id', 'course_id', 'academic_year', 'term']);
            $table->index(['academic_year', 'term']);
            $table->index('enrollment_status');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('student_courses');
    }
};
