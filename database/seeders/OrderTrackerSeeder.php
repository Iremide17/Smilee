<?php

namespace Database\Seeders;

use App\Models\OrderTracker;
use Illuminate\Database\Seeder;

class OrderTrackerSeeder extends Seeder
{
    public function run()
    {

        $tracker = collect([
            $this->createTrack(
                'Order Processed'
            ),
            $this->createTrack(
                'Order Shipped'
            ),
            $this->createTrack(
                'Order En Route'
            ),
            $this->createTrack(
                'Order Arrived'
            ),
        ]);
    }

    private function createTrack(string $name)
    {
        return OrderTracker::factory()->create(compact('name'));
    }
}
