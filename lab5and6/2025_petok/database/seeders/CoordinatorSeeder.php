<?php

namespace Database\Seeders;

use App\Models\Coordinator;
use Illuminate\Database\Seeder;
use Faker\Factory as Faker;

class CoordinatorSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Coordinator::factory()->count(20)->create();
//        $faker = Faker::create();
//
//        foreach (range(1, 20) as $index) {
//            Coordinator::query()->create([
//                'name' => $faker->firstName,
//                'surname' => $faker->lastName,
//                'email' => $faker->unique()->safeEmail,
//                'phone' => $faker->phoneNumber,
//            ]);
//        }
    }
}
