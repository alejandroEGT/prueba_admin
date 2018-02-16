<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateColaboradorProyectoTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('colaborador-proyecto', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('id_colaborador')->unsigned();
            $table->integer('id_proyecto')->unsigned();
            $table->timestamps();

            $table->foreign('id_colaborador')->references('id')->on('colaboradores');
            $table->foreign('id_proyecto')->references('id')->on('proyectos');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('colaborador-proyecto');
    }
}
