<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\AuctionAwards;
use Faker\Generator as Faker;

$factory->define(AuctionAwards::class, function (Faker $faker) {
    return [
    	'auctionDate' => $faker->dateTime(),
        'category' => substr($faker->sentence(2), 0, -1),
        'lotTitle' => substr($faker->sentence(2), 0, -1),
        'lotLocation' => substr($faker->sentence(2), 0, -1),
        'lotCondition' => substr($faker->sentence(2), 0, -1),
        'preTaxAmount' => $faker->randomFloat(2, 1, 100 ),
        'taxName' => substr($faker->sentence(2), 0, -1),
        'taxAmount' => $faker->randomFloat(2, 1, 100 ),
        'created_at' => $faker->dateTime(),
        'created_at' => $faker->dateTime(),
        
    ];
});
