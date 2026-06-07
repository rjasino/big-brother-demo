<?php

declare(strict_types=1);

namespace App\Models;

use Database\Factories\FacultyFactory;
use Illuminate\Database\Eloquent\Attributes\Fillable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;

#[Fillable(['employee_no', 'first_name', 'middle_name', 'last_name', 'email', 'department', 'status'])]
final class Faculty extends Model
{
    /** @use HasFactory<FacultyFactory> */
    use HasFactory;

    protected $table = 'faculty';

    /** @return HasMany<LoadAssignment, $this> */
    public function loadAssignments(): HasMany
    {
        return $this->hasMany(LoadAssignment::class);
    }

    /** @return HasOne<User, $this> */
    public function user(): HasOne
    {
        return $this->hasOne(User::class);
    }
}
