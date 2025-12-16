<?php

namespace Database\Factories;

use App\Enums\EventTypeEnum;
use App\Models\Coordinator;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Event>
 */
class EventFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'name'        => $this->faker->sentence(3),
            'description' => $this->faker->text(60),
            'type'        => $this->faker->randomElement(EventTypeEnum::cases())->value,
            'date'        => $this->faker->dateTimeBetween('+1 days', '+1 year'),
            'coordinator_id'=> Coordinator::factory(),
            // 'coordinator_id' => $coordinators->random()->id,
        ];
    }
}
