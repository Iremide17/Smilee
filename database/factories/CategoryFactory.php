<?php

namespace Database\Factories;

use Illuminate\Support\Str;
use Illuminate\Database\Eloquent\Factories\Factory;

class CategoryFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        $title = $this->faker->text(15);
        return [
            'name'             => $title,
            'slug'              => Str::slug($title . '-' . now()->getPreciseTimestamp(4)),
            'image'             => null,
        ];
    }
}
