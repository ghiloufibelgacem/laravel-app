<?php

/* @var $factory \Illuminate\Database\Eloquent\Factory */

use App\Client;
use Faker\Generator as Faker;

$factory->define(Client::class, function (Faker $faker) {
    return [
        'name'=>$faker->name,
        'email'=>$faker->email,
        'device'=>'android',
        'location'=>'sfax',
        'device_id'=>'ffb3ff5a-ce43-4e62-937f-5ccf335f9a38',
        'lat'=>$faker->'34.7405600',
        'lng'=>$faker->'10.7602800'
    ];
});
