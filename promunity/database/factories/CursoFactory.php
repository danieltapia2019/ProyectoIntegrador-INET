<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Model;
use App\CursoModel;
use Faker\Generator as Faker;

$factory->define(CursoModel::class, function (Faker $faker) {
    return [

          'titulo' => $faker->sentence(6,true),
          'desc' => $faker->text,
          'lenguaje' => $faker->randomElement(array('PHP','JAVA','PYTHON','CSS','HTML','MYSQL')),
          'foto_curso' => $faker->imageUrl(640,480),
          'precio' => $faker->numberBetween(100,2000),
          'duracion' => Null,
          'estado' => 1,
          'tipo_id' => 1,
          'uso_id' => 1,
          'autor'=> 2,
    ];
});
