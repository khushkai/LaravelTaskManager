<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use App\Models\Task;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        $user = User::factory()->create();
        
        Task::factory(10)->create([
            'user_id' => $user->id
        ]);
    }
}