<?php

namespace Database\Seeders;

use Carbon\Carbon;
use App\Models\State;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class StateSeeder extends Seeder
{
    public function run()
    {
        $array = [
            ['FC', 'Abuja'],
            ['AB', 'Abia'],
            ['AD', 'Adamawa'],
            ['AK', 'Akwa Ibom'],
            ['AN', 'Anambra'],
            ['BA', 'Bauchi'],
            ['BY', 'Bayelsa'],
            ['BE', 'Benue'],
            ['BO', 'Borno'],
            ['CR', 'Cross River'],
            ['DE', 'Delta'],
            ['EB', 'Ebonyi'],
            ['ED', 'Edo'],
            ['EK', 'Ekiti'],
            ['EN', 'Enugu'],
            ['GO', 'Gombe'],
            ['IM', 'Imo',],
            ['JI', 'Jigawa'],
            ['KD', 'Kaduna'],
            ['KN', 'Kano'],
            ['KT', 'Katsina'],
            ['KE', 'Kebbi'],
            ['KO', 'Kogi'],
            ['KW', 'Kwara'],
            ['LA', 'Lagos'],
            ['NA', 'Nassarawa'],
            ['NI', 'Niger'],
            ['OG', 'Ogun'],
            ['ON', 'Ondo'],
            ['OS', 'Osun'],
            ['OY', 'Oyo'],
            ['PL', 'Plateau'],
            ['RI', 'Rivers'],
            ['SO', 'Sokoto'],
            ['TA', 'Taraba'],
            ['YO', 'Yobe'],
            ['ZA', 'Zamfara'],
        ];

        foreach ($array as $key => $value):
            $array2[] = [
                'name'       => $value[1],
                'iso_code_2' => $value[0],
                'created_at' => Carbon::now()->toDateTimeString(),
                'updated_at' => Carbon::now()->toDateTimeString(),
            ];
        endforeach ;
        DB::table('states')->insert($array2);
    }
}
