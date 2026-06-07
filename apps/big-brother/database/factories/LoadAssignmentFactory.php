<?php

declare(strict_types=1);

namespace Database\Factories;

use App\Models\Course;
use App\Models\Faculty;
use App\Models\LoadAssignment;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<LoadAssignment>
 */
final class LoadAssignmentFactory extends Factory
{
    /**
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'faculty_id' => Faculty::factory(),
            'course_id' => Course::factory(),
            'academic_year' => '2025-2026',
            'term' => fake()->randomElement(['1st', '2nd', '3rd']),
            'section' => fake()->optional(0.8)->randomElement(['A', 'B', 'C']),
            'status' => 'assigned',
            'assigned_at' => now(),
        ];
    }

    public function completed(): static
    {
        return $this->state(['status' => 'completed']);
    }

    public function cancelled(): static
    {
        return $this->state(['status' => 'cancelled']);
    }
}
