<?php

namespace Database\Factories;

use App\Models\Enrollment;
use Illuminate\Database\Eloquent\Factories\Factory;

class EnrollmentFactory extends Factory
{
    protected $model = Enrollment::class;

    public function definition()
    {
        return [
            'student_name' => $this->faker->name,
            'seats_requested' => 1,
            'status' => 'pending',
        ];
    }
}
