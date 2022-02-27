<?php

namespace Database\Factories;

use App\Models\Agent;
use App\Models\Status;
use Illuminate\Support\Str;
use Illuminate\Database\Eloquent\Factories\Factory;

class PropertyFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        $title = $this->faker->name();

        return [
            'slug'                  =>  Str::slug($title . '-' . now()->getPreciseTimestamp(4)),
            'name'                  =>  $title,
            'type'                  => $this->faker->randomElement(['rent', 'sale']),
            'category'              => $this->faker->randomElement(['sc', 'f', 'ar']),
            'room'                  => rand(1, 5),
            'year_built'            => now(),
            'price'                 => $this->faker->numberBetween($min = 1500, $max = 6000),
            'region'                => $this->faker->city(),
            'address'               =>  $this->faker->city(),
            'latitude'              =>  $this->faker->latitude(-90,90),
            'longitude'             =>  $this->faker->longitude(-90,90),
            'postal_code'           =>  $this->faker->postcode(),
            'image'                 =>  'properties/stock-'. $this->faker->randomElement(['one', 'two', 'three', 'four']) . '.jpg',
            'image_2'               => 'properties/stock-'. $this->faker->randomElement(['one', 'two', 'three', 'four']) . '.jpg',
            'image_3'               => 'properties/stock-'. $this->faker->randomElement(['one', 'two', 'three', 'four']) . '.jpg',
            'video'                 => null,
            'description'           => $this->faker->sentence(),
            'fence'                 => rand(0, 1),
            'tiled'                 => rand(0, 1),
            'well'                  => rand(0, 1),
            'tap'                   => rand(0, 1),
            'toilet'                => rand(0, 1),
            'available'             => rand(0, 1),
            'agent_id'              => $attribute['agent_id'] ?? Agent::factory(),
            'status_id'             => $attribute['status_id'] ?? Status::factory(),
        ];
    }
}

