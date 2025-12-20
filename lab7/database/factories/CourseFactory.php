<?php

namespace Database\Factories;

use App\Models\Course;
use Illuminate\Database\Eloquent\Factories\Factory;
class CourseFactory extends Factory
{
    protected $model = Course::class;

    public function definition()
    {
        return [
            'title' => $this->faker->sentence,
            'summary' => $this->faker->paragraph,
            'level' => 'beginner',
            'start_date' => now()->addWeek(),
            'seats' => 10,
        ];
    }
}
