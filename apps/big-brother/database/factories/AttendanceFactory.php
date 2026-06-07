<?php

declare(strict_types=1);

namespace Database\Factories;

use App\Models\Attendance;
use App\Models\Course;
use App\Models\Student;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<Attendance>
 */
final class AttendanceFactory extends Factory
{
    /**
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'student_id' => Student::factory(),
            'course_id' => Course::factory(),
            'attendance_date' => fake()->dateTimeBetween('-30 days', 'now')->format('Y-m-d'),
            'attendance_status' => fake()->randomElement(['present', 'present', 'present', 'late', 'absent']),
            'remarks' => null,
        ];
    }

    public function present(): static
    {
        return $this->state(['attendance_status' => 'present']);
    }

    public function absent(): static
    {
        return $this->state(['attendance_status' => 'absent']);
    }

    public function late(): static
    {
        return $this->state(['attendance_status' => 'late']);
    }
}
