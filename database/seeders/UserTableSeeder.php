<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\Agent;
use App\Models\Vendor;
use App\Models\Writer;
use Illuminate\Database\Seeder;

class UserTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        User::factory()->create([
            'name'      => 'Shittu Oluwaseun',
            'username'  => 'midshot17',
            'email'     => 'shittuopeyemi24@gmail.com',
            'password'  => bcrypt('midshot17'),
            'type'      => User::SUPERADMIN,
            'profile_photo_path'    => 'profile-photos/author-four.jpg'
        ])->writer()->save(Writer::factory()->make());

        User::factory()->create([
            'name'      => 'Adesodun Olubunmi',
            'username'  => 'olubunmi',
            'email'     => 'bunmi@gmail.com',
            'password'  => bcrypt('password'),
            'type'      => User::VENDOR,
            'profile_photo_path'    => 'profile-photos/author-two.jpg'
        ]);

        User::factory()->create([
            'name'      => 'Obayomi Oluwaseun',
            'username'  => 'oluwaseun',
            'email'     => 'oluwaseun@example.com',
            'password'  => bcrypt('password'),
            'type'      => User::AGENT,
            'profile_photo_path'    => 'profile-photos/author-one.jpg'
        ]);

        User::factory()->create([
            'name'      => 'Idowu Akeem',
            'username'  => 'akeem',
            'email'     => 'akeen@example.com',
            'password'  => bcrypt('password'),
            'type'      => User::VENDOR,
            'profile_photo_path'    => 'profile-photos/author-three.jpg'
        ]);

        User::factory()->create([
            'name'      => 'Molumoh Doris',
            'username'  => 'doris',
            'email'     => 'doris@example.com',
            'password'  => bcrypt('password'),
            'type'      => User::AGENT,
            'profile_photo_path'    => 'profile-photos/author-one.jpg'
        ]);

    }
}
