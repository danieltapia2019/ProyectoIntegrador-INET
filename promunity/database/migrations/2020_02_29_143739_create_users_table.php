<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUsersTable extends Migration
{
    /**
     * Crea la tabla 'users' en la bd
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('username')->unique();
            $table->string('email')->unique();
            $table->string('password');
            $table->rememberToken();
            $table->string('foto',50)->nullable($value = true);
            $table->tinyInteger('acceso');
            $table->timestamps();
        });
    }

    /**
     * Elimina la tabla 'users' de la bd
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('users');
    }
}