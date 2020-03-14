<?php

use Illuminate\Database\Seeder;

class CursoSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('cursos')->insert([
            'titulo' => "Curso de Laravel",
            'desc' => "Curso de Laravel, version 5.8 avanzado.",
            'foto_curso' => "todcEh5cdJMzbbs5KHdQZWAPrmrjgBUtFOL8en0U.png",
            'lenguaje' => "PHP",
            'precio' => 500,
            'duracion' => null,
            'estado'=>1,
            'autor' => 2,
            'tipo_id' =>1,
            'uso_id'=>2
        ]);
        DB::table('cursos')->insert([
            'titulo' => "Curso de PHP",
            'desc' => "Curso de PHP básico.",
            'foto_curso' => "WFFHkIeguYR9N8YnOhbwpMhPDqFPORTFsyRzBLHt.png",
            'lenguaje' => "PHP",
            'precio' => 250,
            'duracion' => null,
            'estado'=>1,
            'autor' => 2,
            'tipo_id' =>1,
            'uso_id'=>2
        ]);
        DB::table('cursos')->insert([
            'titulo' => "Curso de HTML & CSS",
            'desc' => "Curso de HTML & CSS para principiantes.",
            'foto_curso' => "rLTgCaH04dz87grcM5xjqPZzTsC9AJSLwWCjD3QI.jpeg",
            'lenguaje' => "HTML CSS",
            'precio' => 450,
            'duracion' => null,
            'estado'=>1,
            'autor' => 2,
            'tipo_id' =>4,
            'uso_id'=>2
        ]);
        DB::table('cursos')->insert([
            'titulo' => "Curso de Java I",
            'desc' => "Curso de Java para principiantes.",
            'foto_curso' => "Zd4x6ixlpc0RlmMLUpt763wk3yLFEOZD8O9Zvne9.jpeg",
            'lenguaje' => "Java",
            'precio' => 400,
            'duracion' => null,
            'estado'=>1,
            'autor' => 2,
            'tipo_id' =>1,
            'uso_id'=>1
        ]);
    }
}
