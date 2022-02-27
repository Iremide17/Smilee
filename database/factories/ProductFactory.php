<?php

namespace Database\Factories;

use App\Models\Status;
use App\Models\Vendor;
use Illuminate\Support\Str;
use Illuminate\Database\Eloquent\Factories\Factory;

class ProductFactory extends Factory
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
            'title'                 => $title,
            'slug'                  => Str::slug($title . '-' . now()->getPreciseTimestamp(4)),
            'price'                 => $this->faker->numberBetween($min = 1500, $max = 6000),
            'image'                 => 'products/product-'. $this->faker->randomElement(['one', 'two', 'three', 'four']) . '.jpg',
            'type'                  => $this->faker->randomElement(['old', 'new']),
            'code'                  => 'pd'. $this->faker->numberBetween($min = 0000, $max = 0020),
            'description'           => $this->faker->paragraph(5),
            'vendor_id'             => $attribute['vendor_id'] ?? Vendor::factory(),
            'is_commentable'        => rand(0, 1),
            'status_id'             => $attribute['status_id'] ?? Status::factory(),
        ];
    }
}
