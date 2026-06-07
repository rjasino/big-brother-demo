<?php

declare(strict_types=1);

namespace Database\Seeders;

use App\Models\Faculty;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

final class FacultySeeder extends Seeder
{
    public function run(): void
    {
        // Registrar account — no linked faculty record
        User::create([
            'name' => 'Admin Registrar',
            'email' => 'registrar@gocat.edu.ph',
            'password' => Hash::make('password'),
            'role' => 'registrar',
            'faculty_id' => null,
        ]);

        $facultyMembers = [
            [
                'employee_no' => 'FAC-001',
                'first_name' => 'Juan',
                'middle_name' => 'L.',
                'last_name' => 'dela Cruz',
                'email' => 'jdelacruz@gocat.edu.ph',
                'department' => 'Computer Science',
            ],
            [
                'employee_no' => 'FAC-002',
                'first_name' => 'Maria',
                'middle_name' => 'S.',
                'last_name' => 'Santos',
                'email' => 'msantos@gocat.edu.ph',
                'department' => 'Information Systems',
            ],
            [
                'employee_no' => 'FAC-003',
                'first_name' => 'Pedro',
                'middle_name' => 'B.',
                'last_name' => 'Reyes',
                'email' => 'preyes@gocat.edu.ph',
                'department' => 'Multimedia Computing',
            ],
            [
                'employee_no' => 'FAC-004',
                'first_name' => 'Ana',
                'middle_name' => 'C.',
                'last_name' => 'Lim',
                'email' => 'alim@gocat.edu.ph',
                'department' => 'Computer Science',
            ],
            [
                'employee_no' => 'FAC-005',
                'first_name' => 'Jose',
                'middle_name' => 'M.',
                'last_name' => 'Gomez',
                'email' => 'jgomez@gocat.edu.ph',
                'department' => 'Information Systems',
            ],
        ];

        foreach ($facultyMembers as $data) {
            $faculty = Faculty::create(array_merge($data, ['status' => 'active']));

            User::create([
                'name' => $data['first_name'] . ' ' . $data['last_name'],
                'email' => $data['email'],
                'password' => Hash::make('password'),
                'role' => 'faculty',
                'faculty_id' => $faculty->id,
            ]);
        }
    }
}
