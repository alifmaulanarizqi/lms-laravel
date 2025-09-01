<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $users = [
            [
                'name' => 'user1',
                'email' => 'user1@admin.com',
                'password' => bcrypt('12345678'),
                'document' => 'uploads/educore_68b2d40a07e76.pdf',
                'role' => 'student',
            ],  
            [
                'name' => 'user2',
                'email' => 'user2@admin.com',
                'password' => bcrypt('12345678'),
                'document' => 'uploads/educore_68b2d40a07e76.pdf',
                'role' => 'student',
            ],
            [
                'name' => 'instructor1',
                'email' => 'instructor1@admin.com',
                'password' => bcrypt('12345678'),
                'document' => 'uploads/educore_68b2d40a07e76.pdf',
                'role' => 'instructor',
            ],
        ];

        User::insert($users);
    }
}
