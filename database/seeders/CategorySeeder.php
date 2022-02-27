<?php

namespace Database\Seeders;

use App\Models\Category;
use App\Models\Product;
use Carbon\Carbon;
use App\Models\Vendor;
use Illuminate\Database\Seeder;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $category = collect([
            $this->createCategory(
                'Outdoors',
                'outdoors',
                'categories/outdoors.jpg'
            ),
            $this->createCategory(
                'Beauty',
                'beauty',
                'categories/beauty.jpg'
            ),
            $this->createCategory(
                'Environment',
                'environment',
                'categories/environment.jpg'
            ),
            $this->createCategory(
                'Family',
                'family',
                'categories/family.jpg'
            ),
            $this->createCategory(
                'Decor',
                'decor',
                'categories/decor.jpg'
            ),
            $this->createCategory(
                'Fitness',
                'fitness',
                'categories/fitness.jpg'
            ),
            $this->createCategory(
                'Health',
                'health',
                'categories/health.jpg'
            ),
            $this->createCategory(
                'Diy',
                'd-i-y',
                'categories/diy.jpg'
            ),
            $this->createCategory(
                'Furniture',
                'furniture',
                'categories/furniture.jpg'
            ),
        ]);

        Vendor::all()->each(function ($vendor) use ($category) {
            $vendor->syncCategories(
                $category->random(rand(0, $category->count()))
                ->take(2)
                ->pluck('id')
                ->toArray(),
            );
        });

        Product::all()->each(function ($product) use ($category) {
            $product->syncCategories(
                $category->random(rand(0, $category->count()))
                ->take(2)
                ->pluck('id')
                ->toArray(),
            );
        });
    }

    private function createCategory(string $name, string $slug, string $image)
    {
        return Category::factory()->create(compact('name', 'slug', 'image'));
    }
}