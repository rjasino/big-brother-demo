<?php

declare(strict_types=1);

namespace Database\Seeders;

use App\Models\Program;
use Illuminate\Database\Seeder;

final class ProgramSeeder extends Seeder
{
    public function run(): void
    {
        $programs = [
            [
                'code' => 'BSCS',
                'name' => 'Bachelor of Science in Computer Science',
                'description' => 'Focuses on the theory, design, and application of computer systems and algorithms.',
                'status' => 'active',
            ],
            [
                'code' => 'BSEMC',
                'name' => 'Bachelor of Science in Entertainment and Multimedia Computing',
                'description' => 'Combines computing with digital arts, animation, and game development.',
                'status' => 'active',
            ],
            [
                'code' => 'BSIS',
                'name' => 'Bachelor of Science in Information Systems',
                'description' => 'Bridges business processes and information technology through systems analysis and design.',
                'status' => 'active',
            ],
        ];

        foreach ($programs as $program) {
            Program::create($program);
        }
    }
}
