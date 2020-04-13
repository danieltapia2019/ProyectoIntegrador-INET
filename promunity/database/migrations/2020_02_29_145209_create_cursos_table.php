<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCursosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('cursos', function (Blueprint $table) {
            $table->bigIncrements('id');

            $table->string('titulo',100);
            $table->text('desc');
            $table->string('foto_curso',50);
            $table->string('lenguaje',50);
            $table->double('precio',8,2);
            $table->string('duracion',50)->nullable($value = true);
            $table->integer('views');
            $table->tinyInteger('estado')->nullable($value = true);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('cursos');
    }
}
