<?php

declare(strict_types=1);

namespace App\Models;

use Database\Factories\LoadAssignmentFactory;
use Illuminate\Database\Eloquent\Attributes\Fillable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

#[Fillable(['faculty_id', 'course_id', 'academic_year', 'term', 'section', 'status', 'assigned_at'])]
final class LoadAssignment extends Model
{
    /** @use HasFactory<LoadAssignmentFactory> */
    use HasFactory;

    protected function casts(): array
    {
        return ['assigned_at' => 'datetime'];
    }

    /** @return BelongsTo<Faculty, $this> */
    public function faculty(): BelongsTo
    {
        return $this->belongsTo(Faculty::class);
    }

    /** @return BelongsTo<Course, $this> */
    public function course(): BelongsTo
    {
        return $this->belongsTo(Course::class);
    }
}
