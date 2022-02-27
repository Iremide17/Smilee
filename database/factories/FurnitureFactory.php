<?php

namespace Database\Factories;

use App\Models\Status;
use App\Models\Vendor;
use Illuminate\Support\Str;
use Illuminate\Database\Eloquent\Factories\Factory;

class FurnitureFactory extends Factory
{
    public function definition()
    {
        $title = $this->faker->word();

        return [
            'title'                 =>  $title,
            'slug'                  =>  Str::slug($title . '-' . now()->getPreciseTimestamp(4)),
            'price'                 => $this->faker->numberBetween($min = 1500, $max = 6000),
            'type'                  => $this->faker->randomElement(['old', 'new']),
            'image'                 => 'furnitures/furniture-'. $this->faker->randomElement(['one', 'two', 'three', 'four','five']) . '.jpg',
            'image2'                => 'furnitures/furniture-'. $this->faker->randomElement(['one', 'two', 'three', 'four','five']) . '.jpg',
            'image3'                => 'furnitures/furniture-'. $this->faker->randomElement(['one', 'two', 'three', 'four','five']) . '.jpg',
            'description'           =>  $this->faker->paragraph(20),
            'vendor_id'             => $attribute['vendor_id'] ?? Vendor::factory(),
            'status_id'             => $attribute['status_id'] ?? Status::factory(),
        ];
    }
}
