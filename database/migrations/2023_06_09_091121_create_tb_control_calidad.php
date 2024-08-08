<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTbControlCalidad extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tb_control_calidad', function (Blueprint $table) {
            $table->id();
            $table->integer('id_cliente');
            // $table->integer('id_descripcion');
            // $table->integer('id_items');
            $table->integer('orden_entrada');
            $table->integer('orden_salida');
            $table->integer('km');
            $table->date('fecha_revision');
            $table->time('hora_revision');            
            // $table->integer('inspeccion');
            // $table->integer('presion');
            // $table->integer('medida');
            // $table->integer('anio');         
            $table->integer('cedula_entrega');
            $table->integer('cedula_recibe');
            $table->binary('firma_entrega');
            $table->binary('firma_recibe');
            $table->string('motivo', 100)->nullable()->default('text');
            $table->string('observacion', 100)->nullable()->default('text');
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
        Schema::dropIfExists('tb_control_calidad');
    }
}
