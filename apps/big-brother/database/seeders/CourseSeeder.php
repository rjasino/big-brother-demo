<?php

declare(strict_types=1);

namespace Database\Seeders;

use App\Models\Course;
use Illuminate\Database\Seeder;

final class CourseSeeder extends Seeder
{
    public function run(): void
    {
        $courses = [
            // General Education — shared across all programs
            ['code' => 'GE101', 'title' => 'Purposive Communication', 'units' => 3, 'description' => 'Develops communication skills for academic and professional contexts.'],
            ['code' => 'GE102', 'title' => 'Mathematics in the Modern World', 'units' => 3, 'description' => 'Explores the nature of mathematics and its practical applications.'],

            // IT Core — shared across all programs (Year 1)
            ['code' => 'IT101', 'title' => 'Introduction to Computing', 'units' => 3, 'description' => 'Fundamental concepts of computers, software, and information systems.'],
            ['code' => 'IT102', 'title' => 'Programming Fundamentals', 'units' => 3, 'description' => 'Problem-solving and introductory programming using a structured language.'],

            // BSCS — Computer Science core
            ['code' => 'CS201', 'title' => 'Data Structures and Algorithms', 'units' => 3, 'description' => 'Linear and non-linear data structures, sorting, and algorithm analysis.'],
            ['code' => 'CS202', 'title' => 'Discrete Mathematics', 'units' => 3, 'description' => 'Logic, set theory, graph theory, and combinatorics for computer science.'],
            ['code' => 'CS301', 'title' => 'Design and Analysis of Algorithms', 'units' => 3, 'description' => 'Algorithm design paradigms and complexity analysis.'],
            ['code' => 'CS302', 'title' => 'Operating Systems', 'units' => 3, 'description' => 'Process management, memory, file systems, and concurrency.'],

            // BSEMC — Multimedia Computing core
            ['code' => 'EMC201', 'title' => 'Digital Arts Fundamentals', 'units' => 3, 'description' => 'Principles of digital design, color theory, and visual composition.'],
            ['code' => 'EMC202', 'title' => '2D Animation Principles', 'units' => 3, 'description' => 'Frame-by-frame and tween animation techniques using industry tools.'],
            ['code' => 'EMC301', 'title' => '3D Modeling and Rendering', 'units' => 3, 'description' => 'Polygon modeling, texturing, lighting, and rendering workflows.'],
            ['code' => 'EMC302', 'title' => 'Game Design and Development', 'units' => 3, 'description' => 'Game mechanics, level design, and prototyping using a game engine.'],

            // BSIS — Information Systems core
            ['code' => 'IS201', 'title' => 'Systems Analysis and Design', 'units' => 3, 'description' => 'SDLC phases, requirements gathering, and system modeling.'],
            ['code' => 'IS202', 'title' => 'Database Management Systems', 'units' => 3, 'description' => 'Relational model, SQL, normalization, and transaction management.'],
            ['code' => 'IS301', 'title' => 'Enterprise Systems Integration', 'units' => 3, 'description' => 'ERP concepts, integration patterns, and enterprise architecture.'],
            ['code' => 'IS302', 'title' => 'IT Project Management', 'units' => 3, 'description' => 'Project planning, risk management, and agile delivery in IT contexts.'],
        ];

        foreach ($courses as $course) {
            Course::create(array_merge($course, ['status' => 'active']));
        }
    }
}
