<?php

declare(strict_types=1);

namespace Database\Factories;

use App\Models\Course;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<Course>
 */
final class CourseFactory extends Factory
{
    /**
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'code' => fake()->unique()->regexify('[A-Z]{2,3}[0-9]{3}'),
            'title' => fake()->sentence(nb: 3, variableNbWords: false),
            'description' => fake()->optional(0.6)->sentence(),
            'units' => fake()->randomElement([1, 2, 3, 3, 3, 6]),
            'status' => 'active',
        ];
    }

    public function inactive(): static
    {
        return $this->state(['status' => 'inactive']);
    }
}
