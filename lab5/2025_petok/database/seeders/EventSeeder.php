<?php

namespace Database\Seeders;

use App\Models\Coordinator;
use App\Models\Event;
use Illuminate\Database\Seeder;
use Faker\Factory as Faker;

class EventSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $faker = Faker::create();

        $coordinators = Coordinator::all();

        foreach (range(1, 30) as $index) {
            Event::query()->create([
                'name'         => $faker->sentence(3),
                'description'  => $faker->paragraph(3),
                'type'         => $faker->randomElement(['seminar','workshop','lecture']),
                'date'         => $faker->dateTimeBetween('now', '+1 month')->format('Y-m-d'),
                'coordinator_id' => $coordinators->random()->id,
            ]);
        }
    }
}
