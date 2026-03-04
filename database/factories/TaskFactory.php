<?php

namespace Database\Factories;
   use Illuminate\Support\Str;
use Illuminate\Database\Eloquent\Factories\Factory;

class TaskFactory extends Factory
{ 
    public function definition(): array
    {
        return [
            'title' => $this->faker->sentence(),
            'description' => $this->faker->paragraph(),
            'status' => $this->faker->randomElement(['pending', 'completed']),
            'due_date' => $this->faker->date(),
        ];
    }
}
