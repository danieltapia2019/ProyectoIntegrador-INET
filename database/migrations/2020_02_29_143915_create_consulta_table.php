<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateConsultaTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        // Schema::create('password_resets', function (Blueprint $table) {
        //     $table->string('email','40')->index();
        //     $table->string('token');
        //     $table->timestamp('created_at')->nullable();
            
        // });
        Schema::create('consulta', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('nombre','50');
            $table->string('email','40')->unique();
            $table->text('consulta');
            $table->string('telefono','11');

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
        Schema::dropIfExists('password_resets');
        Schema::dropIfExists('consulta');
    }
}
