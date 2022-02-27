<?php

namespace Database\Seeders;

use App\Models\Level;
use Illuminate\Database\Seeder;

class LevelSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $level = [
            [
                'id' => '1',
                'name' => 'NCE I'
            ],
            [
                'id' => '2',
                'name' => 'NCE II'
            ],
            [
                'id' => '3',
                'name' => 'NCE III'
            ],
            [
                'id' => '4',
                'name' => '100lv'
            ],
            [
                'id' => '5',
                'name' => '200lv'
            ],
            [
                'id' => '6',
                'name' => '300lv'
            ],
            [
                'id' => '7',
                'name' => '400lv'
            ],
            [
                'id' => '8',
                'name' => 'Graduate'
            ],
            [
                'id' => '9',
                'name' => 'Others'
            ],
        ];
        Level::Insert($level);
    }
}
