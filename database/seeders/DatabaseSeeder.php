<?php

namespace Database\Seeders;

use Database\Seeders\TagSeeder;
use Illuminate\Database\Seeder;
use Database\Seeders\PostSeeder;
use Database\Seeders\AgentSeeder;
use Database\Seeders\StateSeeder;
use Database\Seeders\StatusSeeder;
use Database\Seeders\ThreadSeeder;
use Database\Seeders\VendorSeeder;
use Database\Seeders\WalletSeeder;
use Database\Seeders\CommentSeeder;
use Database\Seeders\CountrySeeder;
use Database\Seeders\ProductSeeder;
use Database\Seeders\CategorySeeder;
use Database\Seeders\PropertySeeder;
use Database\Seeders\SemesterSeeder;
use Database\Seeders\FurnitureSeeder;
use Database\Seeders\UserTableSeeder;
use Database\Seeders\ApplicationSeeder;
use Database\Seeders\NotificationSeeder;
use Database\Seeders\OrderTrackerSeeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $this->call(ApplicationSeeder::class);
        $this->call(StateSeeder::class);
        $this->call(CountrySeeder::class);
        $this->call(OrderTrackerSeeder::class);
        $this->call(PeriodSeeder::class);
        $this->call(SemesterSeeder::class);
        $this->call(LevelSeeder::class);
        $this->call(StatusSeeder::class);
        $this->call(UserTableSeeder::class);
        $this->call(VendorSeeder::class);
        $this->call(ProductSeeder::class);
        $this->call(CategorySeeder::class);
        $this->call(ThreadSeeder::class);
        $this->call(PostSeeder::class);
        $this->call(TagSeeder::class);
        // $this->call(NotificationSeeder::class);
        $this->call(WalletSeeder::class);
        $this->call(AgentSeeder::class);
        $this->call(PropertySeeder::class);
        $this->call(CommentSeeder::class);
    }
}
