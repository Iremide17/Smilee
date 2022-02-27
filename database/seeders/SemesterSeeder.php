<?php

namespace Database\Seeders;

use App\Models\Period;
use App\Models\Semester;
use Illuminate\Database\Seeder;

class SemesterSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $semester = collect([
            $this->createSemester(
                'Harmattan',
                '0'
            ),
            $this->createSemester(
                'Rain',
                '1'
            ),
        ]);

        Period::all()->each(function ($period) use ($semester) {
            $period->syncSemesters(
                $semester->random(rand(0, $semester->count()))
                ->take(2)
                ->pluck('id')
                ->toArray(),
            );
        });

    }

    private function createSemester(string $name, string $active)
    {
        return Semester::factory()->create(compact('name', 'active'));
    }
}