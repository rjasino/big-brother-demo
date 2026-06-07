<?php

declare(strict_types=1);

namespace Database\Factories;

use App\Models\Course;
use App\Models\Program;
use App\Models\ProgramCourse;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<ProgramCourse>
 */
final class ProgramCourseFactory extends Factory
{
    /**
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'program_id' => Program::factory(),
            'course_id' => Course::factory(),
            'year_level' => fake()->numberBetween(1, 4),
            'term' => fake()->randomElement(['1st', '2nd', '3rd']),
            'is_required' => true,
        ];
    }

    public function elective(): static
    {
        return $this->state(['is_required' => false]);
    }
}
