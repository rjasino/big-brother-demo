<?php

declare(strict_types=1);

namespace Database\Factories;

use App\Models\Course;
use App\Models\Student;
use App\Models\StudentCourse;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<StudentCourse>
 */
final class StudentCourseFactory extends Factory
{
    /**
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'student_id' => Student::factory(),
            'course_id' => Course::factory(),
            'academic_year' => '2025-2026',
            'term' => '1st',
            'enrollment_status' => 'enrolled',
            'enrolled_at' => now(),
        ];
    }

    public function dropped(): static
    {
        return $this->state(['enrollment_status' => 'dropped']);
    }

    public function completed(): static
    {
        return $this->state(['enrollment_status' => 'completed']);
    }
}
