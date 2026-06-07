<?php

declare(strict_types=1);

namespace App\Models;

use Database\Factories\StudentCourseFactory;
use Illuminate\Database\Eloquent\Attributes\Fillable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

#[Fillable(['student_id', 'course_id', 'academic_year', 'term', 'enrollment_status', 'enrolled_at'])]
final class StudentCourse extends Model
{
    /** @use HasFactory<StudentCourseFactory> */
    use HasFactory;

    protected function casts(): array
    {
        return ['enrolled_at' => 'datetime'];
    }

    /** @return BelongsTo<Student, $this> */
    public function student(): BelongsTo
    {
        return $this->belongsTo(Student::class);
    }

    /** @return BelongsTo<Course, $this> */
    public function course(): BelongsTo
    {
        return $this->belongsTo(Course::class);
    }
}
