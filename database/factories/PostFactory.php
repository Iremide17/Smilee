<?php

namespace Database\Factories;

use Illuminate\Support\Str;
use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\Status;
use App\Models\Writer;

class PostFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        $title = $this->faker->sentence();

        return [
            'title'             => $title,
            'slug'              => Str::slug($title . '-' . now()->getPreciseTimestamp(4)),
            'body'              => $this->faker->paragraph(100),
            'is_commentable'    => rand(0, 1),
            'image'             => 'posts/stock-'. $this->faker->randomElement(['one', 'two', 'three', 'four']) . '.jpg',
            'published_at'      => now(),
            'type'              => $this->faker->randomElement(['standard', 'premium']),
            'writer_id'         => $attribute['writer_id'] ?? Writer::factory(),
            'status_id'             => $attribute['status_id'] ?? Status::factory(),
        ];
    }
}
