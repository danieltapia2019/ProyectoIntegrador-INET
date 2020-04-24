<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */


use Illuminate\Support\Str;
use App\AlumnoCurso;
use App\Model;
use App\User;
use App\Transaccion;
use App\CursoModel;
use Faker\Generator as Faker;

$factory->define(AlumnoCurso::class, function (Faker $faker) {

    $curso = CursoModel::inRandomOrder()->first();
    $alumno = User::inRandomOrder()->where('acceso','=','2')->first();
    $transaccion = new Transaccion();
    $transaccion->user_id = $alumno->id;
    $transaccion->curso_id = $curso->id;
    $transaccion->estado = 1;
    $transaccion->referencia = $curso->id.$faker->hexcolor.$alumno->id;
    $transaccion->save();
    return [
          'curso_id' => $curso->id,
          'user_id' => $alumno->id,
    ];
});
