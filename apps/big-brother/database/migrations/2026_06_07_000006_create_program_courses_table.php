<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('program_courses', function (Blueprint $table) {
            $table->id();
            $table->foreignId('program_id')->constrained()->cascadeOnDelete()->cascadeOnUpdate();
            $table->foreignId('course_id')->constrained()->cascadeOnDelete()->cascadeOnUpdate();
            $table->integer('year_level')->nullable();
            $table->string('term', 20)->nullable();
            $table->boolean('is_required')->default(true);
            $table->timestamps();

            $table->unique(['program_id', 'course_id']);
            $table->index(['year_level', 'term']);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('program_courses');
    }
};
