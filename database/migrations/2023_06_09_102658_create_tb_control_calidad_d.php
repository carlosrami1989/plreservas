<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTbControlCalidadD extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tb_control_calidad_d', function (Blueprint $table) {
            $table->id();
            $table->integer('id_control_calidad');
            $table->integer('id_descripcion');
            $table->integer('id_items');
            $table->integer('inspeccion');
            $table->integer('presion');
            $table->integer('medida');
            $table->integer('anio');         
            $table->integer('estado');
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
        Schema::dropIfExists('tb_control_calidad_d');
    }
}
