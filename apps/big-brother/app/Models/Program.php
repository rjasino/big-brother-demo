<?php

declare(strict_types=1);

namespace App\Models;

use Database\Factories\ProgramFactory;
use Illuminate\Database\Eloquent\Attributes\Fillable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

#[Fillable(['code', 'name', 'description', 'status'])]
final class Program extends Model
{
    /** @use HasFactory<ProgramFactory> */
    use HasFactory;

    /** @return HasMany<Student, $this> */
    public function students(): HasMany
    {
        return $this->hasMany(Student::class);
    }

    /** @return HasMany<ProgramCourse, $this> */
    public function programCourses(): HasMany
    {
        return $this->hasMany(ProgramCourse::class);
    }
}
