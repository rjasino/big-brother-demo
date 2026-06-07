<?php

declare(strict_types=1);

namespace App\Models;

use Database\Factories\CourseFactory;
use Illuminate\Database\Eloquent\Attributes\Fillable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

#[Fillable(['code', 'title', 'description', 'units', 'status'])]
final class Course extends Model
{
    /** @use HasFactory<CourseFactory> */
    use HasFactory;

    /** @return HasMany<LoadAssignment, $this> */
    public function loadAssignments(): HasMany
    {
        return $this->hasMany(LoadAssignment::class);
    }

    /** @return HasMany<ProgramCourse, $this> */
    public function programCourses(): HasMany
    {
        return $this->hasMany(ProgramCourse::class);
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
