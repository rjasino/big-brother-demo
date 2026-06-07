<?php

declare(strict_types=1);

namespace Database\Seeders;

use App\Models\Course;
use App\Models\Faculty;
use App\Models\LoadAssignment;
use Illuminate\Database\Seeder;

final class LoadAssignmentSeeder extends Seeder
{
    public function run(): void
    {
        $faculty = Faculty::pluck('id', 'employee_no');
        $courses = Course::pluck('id', 'code');

        // Academic Year 2025-2026, 1st semester
        $assignments = [
            // Juan dela Cruz (FAC-001) — CS dept
            ['employee_no' => 'FAC-001', 'course_code' => 'GE102',  'section' => 'A'],
            ['employee_no' => 'FAC-001', 'course_code' => 'IT101',  'section' => 'A'],
            ['employee_no' => 'FAC-001', 'course_code' => 'CS201',  'section' => 'A'],

            // Maria Santos (FAC-002) — IS dept
            ['employee_no' => 'FAC-002', 'course_code' => 'GE101',  'section' => 'A'],
            ['employee_no' => 'FAC-002', 'course_code' => 'IS202',  'section' => 'A'],
            ['employee_no' => 'FAC-002', 'course_code' => 'IS302',  'section' => 'A'],

            // Pedro Reyes (FAC-003) — Multimedia dept
            ['employee_no' => 'FAC-003', 'course_code' => 'EMC201', 'section' => 'A'],
            ['employee_no' => 'FAC-003', 'course_code' => 'EMC202', 'section' => 'A'],
            ['employee_no' => 'FAC-003', 'course_code' => 'EMC301', 'section' => 'A'],

            // Ana Lim (FAC-004) — CS dept
            ['employee_no' => 'FAC-004', 'course_code' => 'CS202',  'section' => 'A'],
            ['employee_no' => 'FAC-004', 'course_code' => 'CS301',  'section' => 'A'],
            ['employee_no' => 'FAC-004', 'course_code' => 'CS302',  'section' => 'A'],

            // Jose Gomez (FAC-005) — IS dept
            ['employee_no' => 'FAC-005', 'course_code' => 'IS201',  'section' => 'A'],
            ['employee_no' => 'FAC-005', 'course_code' => 'IS301',  'section' => 'A'],
        ];

        foreach ($assignments as $assignment) {
            LoadAssignment::create([
                'faculty_id' => $faculty[$assignment['employee_no']],
                'course_id' => $courses[$assignment['course_code']],
                'academic_year' => '2025-2026',
                'term' => '1st',
                'section' => $assignment['section'],
                'status' => 'assigned',
                'assigned_at' => now(),
            ]);
        }
    }
}
