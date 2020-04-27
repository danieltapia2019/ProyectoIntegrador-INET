<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddForeign extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::enableForeignKeyConstraints();

        Schema::table('cursos', function (Blueprint $table) {
            $table->unsignedBigInteger('autor');//crea la columna
            $table->foreign('autor')->references('id')->on('users');//agrega la clave foranea

            $table->unsignedBigInteger('tipo_id');
            $table->foreign('tipo_id')->references('id')->on('tipos');

            $table->unsignedBigInteger('uso_id');
            $table->foreign('uso_id')->references('id')->on('usos');

            $table->unsignedBigInteger('lenguaje_id');
            $table->foreign('lenguaje_id')->references('id')->on('lenguajes');
        });

        Schema::table('usuario_curso',function(Blueprint $table){
            $table->foreign('curso_id')->references('id')->on('cursos')->onDelete('cascade');;

            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
        });

        
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        // Schema::table('cursos',function(Blueprint $table){
        //     $table->dropForeign('autor');
        //     $table->dropForeign('tipo_id');
        //     $table->dropForeign('uso_id');
        //     $table->dropForeign('lenguaje_id');
        // });
        // Schema::table('usuario_curso',function(Blueprint $table){
        //     $table->dropForeign('curso_id');
        //     $table->dropForeign('user_id');
        // });

        
    }
}
