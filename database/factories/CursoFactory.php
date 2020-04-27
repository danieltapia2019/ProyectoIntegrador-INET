<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Model;
use App\CursoModel;
use App\User;
use App\LenguajeModel;
use App\TipoModel;
use App\UsoModel;

use Faker\Generator as Faker;

$factory->define(CursoModel::class, function (Faker $faker) {
    return [
          'titulo' => $faker->sentence(4,true),
          'desc' => $faker->text,
          'foto_curso' => $faker->imageUrl(640,480),
          'precio' => $faker->numberBetween(100,2000),
          'duracion' => Null,
          'estado' => 1,
          'tipo_id' => function(){
            $tipo = TipoModel::inRandomOrder()->first();
            return $tipo;
          },
          'uso_id' => function(){
            $uso = UsoModel::inRandomOrder()->first();
            return $uso;
          },
          'autor' => function(){
            $profesor = User::inRandomOrder()->where('acceso','=','1')->first();
            return $profesor->id;
          },
          'lenguaje_id' => function(){
            $lng = LenguajeModel::inRandomOrder()->first();
            return $lng->id;
          },
          'views' => 0,
          'created_at'=>$faker->randomElement(array('2020-01-01 00:00:00','2019-01-01 00:00:00')),
    ];
});
