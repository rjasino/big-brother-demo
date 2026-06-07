<?php

declare(strict_types=1);

namespace Database\Factories;

use App\Models\Program;
use App\Models\Student;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<Student>
 */
final class StudentFactory extends Factory
{
    /**
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $year = fake()->numberBetween(2022, 2025);

        return [
            'student_no' => $year . '-' . fake()->unique()->numerify('#####'),
            'program_id' => Program::factory(),
            'first_name' => fake()->firstName(),
            'middle_name' => fake()->optional(0.7)->lastName(),
            'last_name' => fake()->lastName(),
            'email' => fake()->unique()->optional(0.8)->safeEmail(),
            'year_level' => fake()->numberBetween(1, 4),
            'status' => 'active',
        ];
    }

    public function yearLevel(int $level): static
    {
        return $this->state(['year_level' => $level]);
    }

    public function inactive(): static
    {
        return $this->state(['status' => 'inactive']);
    }
}
