<?php

namespace Database\Seeders;

use App\Models\Period;
use Illuminate\Database\Seeder;

class PeriodSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        $period = collect([
            $this->createPeriod(
                '2020/2021',
                '0'
            ),
            $this->createPeriod(
                '2021/2022',
                '1'
            ),
            $this->createPeriod(
                '2022/2023',
                '0'
            ),
            $this->createPeriod(
                '2023/2024',
                '0'
            ),
            $this->createPeriod(
                '2024/2025',
                '0'
            ),
            $this->createPeriod(
                '2025/2026',
                '0'
            ),
        ]);
    }

    private function createPeriod(string $name, string $active)
    {
        return Period::factory()->create(compact('name', 'active'));
    }
}
