<?php

declare(strict_types=1);

namespace Database\Seeders;

use Illuminate\Database\Seeder;

final class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        $this->call([
            ProgramSeeder::class,       // reference data — no FKs
            CourseSeeder::class,        // reference data — no FKs
            FacultySeeder::class,       // faculty + user accounts
            StudentSeeder::class,       // students → programs
            ProgramCourseSeeder::class, // curriculum map → programs + courses
            LoadAssignmentSeeder::class,// teaching load → faculty + courses
            StudentCourseSeeder::class, // enrollments → students + courses
            AttendanceSeeder::class,    // attendance → student_courses
        ]);
    }
}
