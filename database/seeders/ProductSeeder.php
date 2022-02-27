<?php

namespace Database\Seeders;

use App\Models\Product;
use Illuminate\Database\Seeder;

class ProductSeeder extends Seeder
{
    public function run()
    {
        Product::factory()->count(5)->create(['vendor_id' => 1, 'status_id' => 4]);
        Product::factory()->count(5)->create(['vendor_id' => 2, 'status_id' => 4]);
    }
}
