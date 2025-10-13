<?php

namespace Database\Seeders;

use App\Models\Task;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class TaskSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Task::create([
            'title' => 'title 1',
            'description' => 'lorem ipsum 1',
            'user_id' => 2,
            'admin_id' => 1,
        ]);
        Task::create([
            'title' => 'title 2',
            'description' => 'lorem ipsum 2',
            'user_id' => 3,
            'admin_id' => 1,
        ]);

    }
}
