<?php

namespace Database\Seeders;

use App\Models\Vendor;
use Illuminate\Database\Seeder;

class VendorSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Vendor::factory()->count(1)->create(['user_id' => 1, 'status_id' => 4]);
        Vendor::factory()->count(1)->create(['user_id' => 2, 'status_id' => 4]);
        Vendor::factory()->count(1)->create(['user_id' => 3, 'status_id' => 4]);
        Vendor::factory()->count(1)->create(['user_id' => 4, 'status_id' => 4]);
        Vendor::factory()->count(1)->create(['user_id' => 5, 'status_id' => 4]);
    }
}
