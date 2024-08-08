<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTbTareasSeguimiento extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tb_tareas_seguimiento', function (Blueprint $table) {
            $table->id();
            $table->integer('id_tareas');
            $table->string('titulo', 200)->nullable()->default('text');
            $table->string('observacion', 500)->nullable()->default('text');
            $table->string('ruta_imagen', 500)->nullable()->default('text');
            $table->datetime('fecha_seguimiento');
            $table->integer('usuario_ingreso');
            $table->integer('usuario_modificacion');
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
        Schema::dropIfExists('tb_tareas_seguimiento');
    }
}
