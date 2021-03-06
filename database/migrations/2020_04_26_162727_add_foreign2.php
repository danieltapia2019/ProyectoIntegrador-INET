<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddForeign2 extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::enableForeignKeyConstraints();

        Schema::table('transaccion',function(Blueprint $table){
            $table->foreign('curso_id')->references('id')->on('cursos')->onDelete('cascade');;

            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');;
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        // Schema::table('transaccion',function(Blueprint $table){
        //     $table->dropForeign('curso_id');
        //     $table->dropForeign('user_id');
        // });
    }
}
