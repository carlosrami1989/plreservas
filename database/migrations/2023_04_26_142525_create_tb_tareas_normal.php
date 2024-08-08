<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTbTareasNormal extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tb_tareas_normal', function (Blueprint $table) {
            $table->id();
            $table->string('descripcion', 200)->nullable()->default('text');
            $table->string('observacion', 200)->nullable()->default('text');
            $table->integer('id_persona');
            $table->integer('id_empresa');
            $table->integer('estado_tarea');
            $table->integer('estado');
            $table->integer('usuario_ingreso');
            $table->integer('usuario_modificacion');
            $table->date('fecha_inicio');
            $table->date('fecha_fin');
          
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
        Schema::dropIfExists('tb_tareas_normal');
    }
}
