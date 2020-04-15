<?php

use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;
use App\User;
use App\CursoModel;
use App\ConsultaModel;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $this->call(TipoUsoSeeder::class);
        $this->call(UserSeeder::class);
        $usuarios = factory(User::class)->times(20)->create();
        $cursos = factory(CursoModel::class)->times(20)->create();
        $consultas = factory(ConsultaModel::class)->times(20)->create();
    }
}
