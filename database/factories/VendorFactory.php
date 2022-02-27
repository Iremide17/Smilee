<?php

namespace Database\Factories;

use App\Models\Status;
use Illuminate\Support\Str;
use Illuminate\Database\Eloquent\Factories\Factory;

class VendorFactory extends Factory 
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        $title = $this->faker->word();

        return [
            'name'                  =>  $title,
            'slug'                  =>  Str::slug($title . '-' . now()->getPreciseTimestamp(4)),
            'phone'                 =>  $this->faker->phoneNumber(),
            'email'                 =>  $this->faker->unique()->safeEmail(),
            'address'               =>  $this->faker->city(),
            'latitude'              =>  $this->faker->latitude(-90,90),
            'longitude'             =>  $this->faker->longitude(-90,90),
            'postal_code'           =>  $this->faker->postcode(),
            'image'                 =>  'vendors/rocket.png',
            'banner'                =>  'vendors/bg-header.jpg',
            'description'           =>  $this->faker->sentence(),
            'status_id'             => $attribute['status_id'] ?? Status::factory(),
        ];
    }
}
