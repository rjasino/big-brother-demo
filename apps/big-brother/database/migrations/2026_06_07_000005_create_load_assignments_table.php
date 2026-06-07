<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('load_assignments', function (Blueprint $table) {
            $table->id();
            $table->foreignId('faculty_id')->constrained('faculty')->restrictOnDelete()->cascadeOnUpdate();
            $table->foreignId('course_id')->constrained()->restrictOnDelete()->cascadeOnUpdate();
            $table->string('academic_year', 20);
            $table->string('term', 20);
            $table->string('section', 20)->nullable();
            $table->string('status', 20)->default('assigned');
            $table->timestamp('assigned_at');
            $table->timestamps();

            $table->unique(['faculty_id', 'course_id', 'academic_year', 'term', 'section']);
            $table->index(['academic_year', 'term']);
            $table->index('status');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('load_assignments');
    }
};
