<?php

use Illuminate\Database\Seeder;

class TipoUsoSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('tipos')->insert([
            'tipoNombre' => "Orientado a Objetos",
            'estado'=>1
        ]);
        DB::table('tipos')->insert([
            'tipoNombre' => "Funcional",
            'estado'=>1
        ]);
        DB::table('tipos')->insert([
            'tipoNombre' => "Base de Datos",
            'estado'=>1
        ]);
        DB::table('tipos')->insert([
            'tipoNombre' => "Frontend",
            'estado'=>1
        ]);
        DB::table('usos')->insert([
            'usoNombre' => "General",
            'estado'=>1
        ]);
        DB::table('usos')->insert([
            'usoNombre' => "Web",
            'estado'=>1
        ]);
        DB::table('usos')->insert([
            'usoNombre' => "Movil",
            'estado'=>1
        ]);
    }
}
