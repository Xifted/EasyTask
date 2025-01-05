<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Carbon\Carbon;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        // Seed User Levels
        DB::table('user_levels')->insert([
            ['name_level' => 'Admin', 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()],
            ['name_level' => 'User', 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()],
            ['name_level' => 'Banned', 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()],
        ]);

        // Seed Users
        DB::table('users')->insert([
            [
                'name' => 'Admin User',
                'email' => 'admin@example.com',
                'password' => Hash::make('password'),
                'level_id' => 1, // Admin
                'remember_token' => null,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'name' => 'Regular User',
                'email' => 'user@example.com',
                'password' => Hash::make('password'),
                'level_id' => 2, // User
                'remember_token' => null,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
        ]);
        for ($i = 1; $i <= 50; $i++) {
            DB::table('users')->insert([
                'name' => 'User ' . $i,
                'email' => 'user' . $i . '@example.com',
                'password' => Hash::make('password'),
                'level_id' => 2, // Regular User
                'remember_token' => null,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ]);
        }

        // Seed Task Status
        DB::table('task_status')->insert([
            ['name' => 'To Do', 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()],
            ['name' => 'In Progress', 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()],
            ['name' => 'Done', 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()],
        ]);

        // Seed Tasks
        DB::table('tasks')->insert([
            [
                'user_id' => 2, // Regular User
                'name' => 'Personal Task',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'user_id' => 2, // Regular User
                'name' => 'Work Task',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
        ]);

        // Seed Task Details
        DB::table('task_details')->insert([
            [
                'task_id' => 1, // Personal Task
                'title' => 'Morning Exercise',
                'description' => 'Complete 30 minutes of exercise',
                'deadline' => Carbon::now()->addDay(),
                'status_id' => 1, // Pending
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'task_id' => 2, // Work Task
                'title' => 'Submit Report',
                'description' => 'Submit the monthly financial report',
                'deadline' => Carbon::now()->addDays(2),
                'status_id' => 2, // In Progress
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
        ]);
    }
}
