<?php

declare(strict_types=1);

namespace App\Models;

use Database\Factories\UserFactory;
use Illuminate\Database\Eloquent\Attributes\Fillable;
use Illuminate\Database\Eloquent\Attributes\Hidden;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

#[Fillable(['name', 'email', 'password', 'role', 'faculty_id'])]
#[Hidden(['password', 'remember_token'])]
final class User extends Authenticatable
{
    /** @use HasFactory<UserFactory> */
    use HasFactory, Notifiable;

    protected function casts(): array
    {
        return [
            'password' => 'hashed',
        ];
    }

    /** @return BelongsTo<\App\Models\Faculty, $this> */
    public function faculty(): BelongsTo
    {
        return $this->belongsTo(\App\Models\Faculty::class);
    }

    public function isRegistrar(): bool
    {
        return $this->role === 'registrar';
    }

    public function isFaculty(): bool
    {
        return $this->role === 'faculty';
    }
}
