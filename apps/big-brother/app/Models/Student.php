<?php

declare(strict_types=1);

namespace App\Models;

use Database\Factories\StudentFactory;
use Illuminate\Database\Eloquent\Attributes\Fillable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

#[Fillable(['student_no', 'program_id', 'first_name', 'middle_name', 'last_name', 'email', 'year_level', 'status'])]
final class Student extends Model
{
    /** @use HasFactory<StudentFactory> */
    use HasFactory;

    /** @return BelongsTo<Program, $this> */
    public function program(): BelongsTo
    {
        return $this->belongsTo(Program::class);
    }

    /** @return HasMany<StudentCourse, $this> */
    public function studentCourses(): HasMany
    {
        return $this->hasMany(StudentCourse::class);
    }

    /** @return HasMany<Attendance, $this> */
    public function attendances(): HasMany
    {
        return $this->hasMany(Attendance::class);
    }
}
