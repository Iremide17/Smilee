<?php

namespace Database\Seeders;

use App\Models\Furniture;
use Illuminate\Database\Seeder;

class FurnitureSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Furniture::factory()->count(2)->create(['vendor_id' => 1, 'status_id' => 4]);
        Furniture::factory()->count(2)->create(['vendor_id' => 2, 'status_id' => 4]);
    }
}
