<?php

namespace Database\Seeders;

use App\Models\Status;
use Illuminate\Database\Seeder;

class StatusSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        $status = collect([
            $this->createStatus(
                'Pending'
            ),
            $this->createStatus(
                'Processing'
            ),
            $this->createStatus(
                'Accepted'
            ),
            $this->createStatus(
                'Verified'
            ),
            $this->createStatus(
                'Rejected'
            ),
            $this->createStatus(
                'Ban'
            )
        ]);
    }

    private function createStatus(string $name)
    {
        return Status::factory()->create(compact('name'));
    }
}
