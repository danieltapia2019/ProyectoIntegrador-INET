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
            $table->string('username','25')->unique();
            $table->string('email','40')->unique();
            $table->string('password');
            $table->rememberToken();
            $table->string('foto',50)->nullable($value = true);
            $table->tinyInteger('acceso');
            $table->text('opinion')->nullable($value = true);
            $table->tinyInteger('estado')->nullable($value = true);
            $table->timestamps();
        });
    }
    cdsacdsacdsacsadsddsadsa3dsadsadsad
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
