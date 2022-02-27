<?php

namespace Database\Seeders;

use App\Models\Agent;
use Illuminate\Database\Seeder;

class AgentSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Agent::factory()->count(1)->create(['user_id' => 1, 'status_id' => 4]);
        Agent::factory()->count(1)->create(['user_id' => 2, 'status_id' => 4]);
        Agent::factory()->count(1)->create(['user_id' => 3, 'status_id' => 4]);
    }
}
