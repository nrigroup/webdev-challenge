<?php

use Illuminate\Database\Seeder;

class AuctionAwardsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(App\AuctionAwards::class, 11)->create();
    }
}
