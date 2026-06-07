<?php

declare(strict_types=1);

namespace Database\Seeders;

use App\Models\Course;
use App\Models\Student;
use App\Models\StudentCourse;
use Illuminate\Database\Seeder;

final class StudentCourseSeeder extends Seeder
{
    public function run(): void
    {
        $courses = Course::pluck('id', 'code');

        // Courses offered in 2025-2026, 1st semester by year level and program
        $curriculum = [
            1 => ['GE101', 'GE102', 'IT101'],           // all programs, Year 1
            'BSCS' => [
                2 => ['CS201', 'CS202'],
                3 => ['CS301', 'CS302'],
            ],
            'BSEMC' => [
                2 => ['EMC201', 'EMC202'],
                3 => ['EMC301', 'EMC302'],
            ],
            'BSIS' => [
                2 => ['IS201', 'IS202'],
                3 => ['IS301', 'IS302'],
            ],
        ];

        $students = Student::with('program')->get();

        foreach ($students as $student) {
            $programCode = $student->program->code;
            $yearLevel = $student->year_level;

            $courseCodes = $yearLevel === 1
                ? $curriculum[1]
                : ($curriculum[$programCode][$yearLevel] ?? []);

            foreach ($courseCodes as $code) {
                StudentCourse::create([
                    'student_id' => $student->id,
                    'course_id' => $courses[$code],
                    'academic_year' => '2025-2026',
                    'term' => '1st',
                    'enrollment_status' => 'enrolled',
                    'enrolled_at' => now(),
                ]);
            }
        }
    }
}
