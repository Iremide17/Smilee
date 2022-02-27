<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class ThreadFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'title'         => $this->faker->text(30),
            'body'          => $this->faker->paragraph(2, true),
            'slug'          => $this->faker->unique()->slug,
            'author_id'     => rand(1, 4),
            'category_id'   => rand(1, 4),
        ];
    }
}
