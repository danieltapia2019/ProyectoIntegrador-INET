<?php

use Illuminate\Database\Seeder;

class LenguajeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('lenguajes')->insert([
            'nombreLenguaje' => "C",
            'estado'=>1
        ]);
        DB::table('lenguajes')->insert([
            'nombreLenguaje' => "C++",
            'estado'=>1
        ]);
        DB::table('lenguajes')->insert([
            'nombreLenguaje' => "C#",
            'estado'=>1
        ]);
        DB::table('lenguajes')->insert([
            'nombreLenguaje' => "CSS",
            'estado'=>1
        ]);
        DB::table('lenguajes')->insert([
            'nombreLenguaje' => "Go",
            'estado'=>1
        ]);
        DB::table('lenguajes')->insert([
            'nombreLenguaje' => "HTML",
            'estado'=>1
        ]);
        DB::table('lenguajes')->insert([
            'nombreLenguaje' => "Kotlin",
            'estado'=>1
        ]);
        DB::table('lenguajes')->insert([
            'nombreLenguaje' => "Java",
            'estado'=>1
        ]);
        DB::table('lenguajes')->insert([
            'nombreLenguaje' => "JavaScript",
            'estado'=>1
        ]);
        DB::table('lenguajes')->insert([
            'nombreLenguaje' => "NoSQL",
            'estado'=>1
        ]);
        DB::table('lenguajes')->insert([
            'nombreLenguaje' => "PHP",
            'estado'=>1
        ]);
        DB::table('lenguajes')->insert([
            'nombreLenguaje' => "Python",
            'estado'=>1
        ]);
        DB::table('lenguajes')->insert([
            'nombreLenguaje' => "Rust",
            'estado'=>1
        ]);
        DB::table('lenguajes')->insert([
            'nombreLenguaje' => "SQL",
            'estado'=>1
        ]);
        DB::table('lenguajes')->insert([
            'nombreLenguaje' => "Swift",
            'estado'=>1
        ]);
        DB::table('lenguajes')->insert([
            'nombreLenguaje' => "TypeScript",
            'estado'=>1
        ]);
    }
}
