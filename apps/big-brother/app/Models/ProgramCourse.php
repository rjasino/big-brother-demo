<?php

declare(strict_types=1);

namespace App\Models;

use Database\Factories\ProgramCourseFactory;
use Illuminate\Database\Eloquent\Attributes\Fillable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

#[Fillable(['program_id', 'course_id', 'year_level', 'term', 'is_required'])]
final class ProgramCourse extends Model
{
    /** @use HasFactory<ProgramCourseFactory> */
    use HasFactory;

    protected function casts(): array
    {
        return ['is_required' => 'boolean'];
    }

    /** @return BelongsTo<Program, $this> */
    public function program(): BelongsTo
    {
        return $this->belongsTo(Program::class);
    }

    /** @return BelongsTo<Course, $this> */
    public function course(): BelongsTo
    {
        return $this->belongsTo(Course::class);
    }
}
