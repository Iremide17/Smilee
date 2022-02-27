<?php

namespace Database\Factories;

use App\Models\Status;
use Illuminate\Support\Str;
use Illuminate\Database\Eloquent\Factories\Factory;

class AgentFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        $name = $this->faker->word();

        return [
            'name'                  =>  $name,
            'slug'                  =>  Str::slug($name . '-' . now()->getPreciseTimestamp(4)),
            'phone'                 =>  $this->faker->phoneNumber(),
            'email'                 =>  $this->faker->unique()->safeEmail(),
            'address'               =>  $this->faker->city(),
            'instagram'             =>  'midshot17',
            'facebook'              =>  'midshot17',
            'twitter'               =>  'midshot17',
            'linkedin'              =>  'midshot17',
            'area_covered'          =>  'midshot17',
            'website'               =>  'midshot17',
            'language'              =>  'English, Yoruba',
            'image'                 =>  'agents/stock-'. $this->faker->randomElement(['one', 'two', 'three', 'four']) . '.jpg',
            'description'           =>  $this->faker->sentence(),
            'status_id'             => $attribute['status_id'] ?? Status::factory(),
        ];
    }
}
