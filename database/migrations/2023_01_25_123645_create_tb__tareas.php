<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTbTareas extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tb_tareas', function (Blueprint $table) {
            $table->id();
            $table->string('descripcion', 200)->nullable()->default('text');
            $table->string('observacion', 200)->nullable()->default('text');
            $table->integer('id_persona');
            $table->integer('estado_tarea');
            $table->integer('estado');
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
        Schema::dropIfExists('tb__tareas');
    }
}
