<?php

use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;
use App\User;

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
        $this->call(CursoSeeder::class);
        factory(User::class)->times(20)->create();
    }
}
