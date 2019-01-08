<?php

use Faker\Generator as Faker;

$factory->define(App\Transaction::class, function (Faker $faker) {
    return [
        'description' => $faker->sentence(2),
        'amount'=>$faker->numberBetween(5,10),
        'category_id'=>function(){
            return factory(App\Category::class)->create()->id;
        },
        'user_id'=>function(){
        return factory(App\User::class)->create()->id;
    }
    ];
});
