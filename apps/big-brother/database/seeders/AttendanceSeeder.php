<?php

declare(strict_types=1);

namespace Database\Seeders;

use App\Models\Attendance;
use App\Models\StudentCourse;
use Illuminate\Database\Seeder;

final class AttendanceSeeder extends Seeder
{
    /** @var list<string> */
    private const SCHOOL_DATES = [
        '2026-06-02', '2026-06-03', '2026-06-04', '2026-06-05', '2026-06-06',
        '2026-06-09', '2026-06-10', '2026-06-11', '2026-06-12', '2026-06-13',
    ];

    /** @var list<string> */
    private const STATUSES = ['present', 'present', 'present', 'present', 'present', 'late', 'late', 'absent'];

    public function run(): void
    {
        $enrollments = StudentCourse::where('enrollment_status', 'enrolled')->get();

        foreach ($enrollments as $enrollment) {
            foreach (self::SCHOOL_DATES as $date) {
                Attendance::create([
                    'student_id' => $enrollment->student_id,
                    'course_id' => $enrollment->course_id,
                    'attendance_date' => $date,
                    'attendance_status' => self::STATUSES[array_rand(self::STATUSES)],
                    'remarks' => null,
                ]);
            }
        }
    }
}
