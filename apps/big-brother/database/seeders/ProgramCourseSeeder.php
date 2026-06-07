<?php

declare(strict_types=1);

namespace Database\Seeders;

use App\Models\Course;
use App\Models\Program;
use App\Models\ProgramCourse;
use Illuminate\Database\Seeder;

final class ProgramCourseSeeder extends Seeder
{
    public function run(): void
    {
        $programs = Program::pluck('id', 'code');
        $courses = Course::pluck('id', 'code');

        // Courses shared across all three programs
        $shared = [
            ['code' => 'GE101', 'year_level' => 1, 'term' => '1st'],
            ['code' => 'GE102', 'year_level' => 1, 'term' => '1st'],
            ['code' => 'IT101', 'year_level' => 1, 'term' => '1st'],
            ['code' => 'IT102', 'year_level' => 1, 'term' => '2nd'],
        ];

        foreach ($programs as $programId) {
            foreach ($shared as $course) {
                ProgramCourse::create([
                    'program_id' => $programId,
                    'course_id' => $courses[$course['code']],
                    'year_level' => $course['year_level'],
                    'term' => $course['term'],
                    'is_required' => true,
                ]);
            }
        }

        // Program-specific courses
        $specific = [
            'BSCS' => [
                ['code' => 'CS201', 'year_level' => 2, 'term' => '1st'],
                ['code' => 'CS202', 'year_level' => 2, 'term' => '1st'],
                ['code' => 'CS301', 'year_level' => 3, 'term' => '1st'],
                ['code' => 'CS302', 'year_level' => 3, 'term' => '1st'],
            ],
            'BSEMC' => [
                ['code' => 'EMC201', 'year_level' => 2, 'term' => '1st'],
                ['code' => 'EMC202', 'year_level' => 2, 'term' => '1st'],
                ['code' => 'EMC301', 'year_level' => 3, 'term' => '1st'],
                ['code' => 'EMC302', 'year_level' => 3, 'term' => '1st'],
            ],
            'BSIS' => [
                ['code' => 'IS201', 'year_level' => 2, 'term' => '1st'],
                ['code' => 'IS202', 'year_level' => 2, 'term' => '1st'],
                ['code' => 'IS301', 'year_level' => 3, 'term' => '1st'],
                ['code' => 'IS302', 'year_level' => 3, 'term' => '1st'],
            ],
        ];

        foreach ($specific as $programCode => $programCourses) {
            foreach ($programCourses as $course) {
                ProgramCourse::create([
                    'program_id' => $programs[$programCode],
                    'course_id' => $courses[$course['code']],
                    'year_level' => $course['year_level'],
                    'term' => $course['term'],
                    'is_required' => true,
                ]);
            }
        }
    }
}
