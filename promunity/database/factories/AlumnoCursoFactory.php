<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */


use Illuminate\Support\Str;
use App\AlumnoCurso;
use App\Model;
use App\User;
use App\CursoModel;
use Faker\Generator as Faker;

$factory->define(AlumnoCurso::class, function (Faker $faker) {
    return [
          'curso_id' => function(){
            $curso = CursoModel::inRandomOrder()->first();
            return $curso->id;
          },
          'user_id' => function(){
            $alumno = User::inRandomOrder()->where('acceso','=','2')->first();
            return $alumno->id;
          },
          'transaccion' => $faker->randomNumber(),
          'pagado' => 1,
    ];
});
