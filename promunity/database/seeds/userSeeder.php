<?php

use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //Admin,
        DB::table('users')->insert([
            'username' => "admin01",
            'email'=> "admin@g.com",
            'password'=> bcrypt('admin1234'),
            'remember_token'=> null,
            'foto'=> null,
            'acceso'=> 0,
            'opinion'=> null,
            'estado'=>1
        ]);
        //Profesor
        DB::table('users')->insert([
            'username' => "david01",
            'email'=> "david@g.com",
            'password'=> bcrypt('david1234'),
            'remember_token'=> null,
            'foto'=> null,
            'acceso'=> 1,
            'opinion'=> null,
            'estado'=>1
        ]);
    }
}
