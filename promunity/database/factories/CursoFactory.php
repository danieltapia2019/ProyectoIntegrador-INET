<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\CursoModel;
use Faker\Generator as Faker;

$factory->define(CursoModel::class, function (Faker $faker) {
    return [
      'titulo'=>$faker->sentence(4),
      'desc'=>$faker->sentence(40),
      'foto_curso'=>$faker->username .".jpg",
      'lenguaje'=>$faker->state,
      'precio'=>$faker->numberBetween(100,400),
      'autor'=>$faker->numberBetween(1,5),
      'tipo_id'=>$faker->numberBetween(1,3),
      'uso_id'=>$faker->numberBetween(1,3)
    ];
});
