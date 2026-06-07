<?php

declare(strict_types=1);

namespace Database\Seeders;

use App\Models\Program;
use App\Models\Student;
use Illuminate\Database\Seeder;

final class StudentSeeder extends Seeder
{
    public function run(): void
    {
        $programs = Program::pluck('id', 'code');

        $students = [
            // BSCS
            ['student_no' => '2025-00001', 'program' => 'BSCS', 'first_name' => 'Carlo',    'middle_name' => 'D.',  'last_name' => 'Mendoza',   'year_level' => 1, 'email' => 'carlo.mendoza@student.gocat.edu.ph'],
            ['student_no' => '2025-00002', 'program' => 'BSCS', 'first_name' => 'Sofia',    'middle_name' => 'A.',  'last_name' => 'Reyes',     'year_level' => 1, 'email' => 'sofia.reyes@student.gocat.edu.ph'],
            ['student_no' => '2024-00001', 'program' => 'BSCS', 'first_name' => 'Miguel',   'middle_name' => 'B.',  'last_name' => 'Torres',    'year_level' => 2, 'email' => 'miguel.torres@student.gocat.edu.ph'],
            ['student_no' => '2024-00002', 'program' => 'BSCS', 'first_name' => 'Alyssa',   'middle_name' => 'C.',  'last_name' => 'Bautista',  'year_level' => 2, 'email' => 'alyssa.bautista@student.gocat.edu.ph'],
            ['student_no' => '2023-00001', 'program' => 'BSCS', 'first_name' => 'Ryan',     'middle_name' => 'E.',  'last_name' => 'Cruz',      'year_level' => 3, 'email' => 'ryan.cruz@student.gocat.edu.ph'],

            // BSEMC
            ['student_no' => '2025-00003', 'program' => 'BSEMC', 'first_name' => 'Jasmine',  'middle_name' => 'F.',  'last_name' => 'Santos',    'year_level' => 1, 'email' => 'jasmine.santos@student.gocat.edu.ph'],
            ['student_no' => '2025-00004', 'program' => 'BSEMC', 'first_name' => 'Marco',    'middle_name' => 'G.',  'last_name' => 'Villanueva','year_level' => 1, 'email' => 'marco.villanueva@student.gocat.edu.ph'],
            ['student_no' => '2024-00003', 'program' => 'BSEMC', 'first_name' => 'Kristine', 'middle_name' => 'H.',  'last_name' => 'dela Rosa', 'year_level' => 2, 'email' => 'kristine.delarosa@student.gocat.edu.ph'],
            ['student_no' => '2024-00004', 'program' => 'BSEMC', 'first_name' => 'Paolo',    'middle_name' => 'I.',  'last_name' => 'Hernandez', 'year_level' => 2, 'email' => 'paolo.hernandez@student.gocat.edu.ph'],
            ['student_no' => '2023-00002', 'program' => 'BSEMC', 'first_name' => 'Camille',  'middle_name' => 'J.',  'last_name' => 'Morales',   'year_level' => 3, 'email' => 'camille.morales@student.gocat.edu.ph'],

            // BSIS
            ['student_no' => '2025-00005', 'program' => 'BSIS', 'first_name' => 'Jerome',   'middle_name' => 'K.',  'last_name' => 'Aquino',    'year_level' => 1, 'email' => 'jerome.aquino@student.gocat.edu.ph'],
            ['student_no' => '2025-00006', 'program' => 'BSIS', 'first_name' => 'Patricia', 'middle_name' => 'L.',  'last_name' => 'Garcia',    'year_level' => 1, 'email' => 'patricia.garcia@student.gocat.edu.ph'],
            ['student_no' => '2024-00005', 'program' => 'BSIS', 'first_name' => 'Kevin',    'middle_name' => 'M.',  'last_name' => 'Flores',    'year_level' => 2, 'email' => 'kevin.flores@student.gocat.edu.ph'],
            ['student_no' => '2024-00006', 'program' => 'BSIS', 'first_name' => 'Maricel',  'middle_name' => 'N.',  'last_name' => 'Ramos',     'year_level' => 2, 'email' => 'maricel.ramos@student.gocat.edu.ph'],
            ['student_no' => '2023-00003', 'program' => 'BSIS', 'first_name' => 'Dennis',   'middle_name' => 'O.',  'last_name' => 'Lopez',     'year_level' => 3, 'email' => 'dennis.lopez@student.gocat.edu.ph'],
        ];

        foreach ($students as $data) {
            Student::create([
                'student_no' => $data['student_no'],
                'program_id' => $programs[$data['program']],
                'first_name' => $data['first_name'],
                'middle_name' => $data['middle_name'],
                'last_name' => $data['last_name'],
                'email' => $data['email'],
                'year_level' => $data['year_level'],
                'status' => 'active',
            ]);
        }
    }
}
