<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Model;
use App\ConsultaModel;
use Faker\Generator as Faker;

$factory->define(ConsultaModel::class, function (Faker $faker) {
    return [
        'nombre' => $faker->name,
        'email' => $faker->unique()->safeEmail,
        'consulta' => $faker->text,
        'telefono' => $faker->numberBetween(100,2000),
        'created_at'=>$faker->randomElement(array('2020-01-01 00:00:00','2019-01-01 00:00:00'))
    ];
});
