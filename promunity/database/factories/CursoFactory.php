<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Model;
use App\CursoModel;
use App\User;
use Faker\Generator as Faker;

$factory->define(CursoModel::class, function (Faker $faker) {
    return [
          'titulo' => $faker->sentence(4,true),
          'desc' => $faker->text,
          'lenguaje' => $faker->randomElement(array('PHP','Java','Python','CSS','HTML','MYSQL','JS')),
          'foto_curso' => $faker->imageUrl(640,480),
          'precio' => $faker->numberBetween(100,2000),
          'duracion' => Null,
          'estado' => 1,
          'tipo_id' => 1,
          'uso_id' => 1,
          'autor' => function(){
            $profesor = User::inRandomOrder()->where('acceso','=','1')->first();
            return $profesor->id;
          },
          'views' => 0,
          'tipo_id' => $faker->randomElement(array(1,2,3,4)),
          'uso_id' => $faker->randomElement(array(1,2,3,4)),
          'autor'=> 2,
          'created_at'=>$faker->randomElement(array('2020-01-01 00:00:00','2019-01-01 00:00:00'))
    ];
});
