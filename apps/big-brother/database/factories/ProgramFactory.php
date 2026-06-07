<?php

declare(strict_types=1);

namespace Database\Factories;

use App\Models\Program;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<Program>
 */
final class ProgramFactory extends Factory
{
    /**
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'code' => fake()->unique()->regexify('BS[A-Z]{2,4}'),
            'name' => 'Bachelor of Science in ' . fake()->words(nb: 2, asText: true),
            'description' => fake()->optional(0.6)->sentence(),
            'status' => 'active',
        ];
    }

    public function inactive(): static
    {
        return $this->state(['status' => 'inactive']);
    }
}
