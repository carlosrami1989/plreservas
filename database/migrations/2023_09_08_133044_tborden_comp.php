<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class TbordenComp extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        //
        Schema::create('tb_orden_compl', function (Blueprint $table) {
            $table->integer('id')->autoIncrement();
            $table->string('orden', 100)->nullable()->default('0');
            $table->string('cliente', 100)->nullable()->default('0');
            $table->string('estacion', 100)->nullable()->default('0');
            $table->integer('codigo');
            $table->string('cod_estacion', 100)->nullable()->default('0');
            $table->dateTime('fecha_emision');
            $table->dateTime('fecha_vencimiento');
            $table->dateTime('fecha_venta');
            $table->string('guia', 100)->nullable()->default('0');
            $table->string('nombre', 100)->nullable()->default('0');
            $table->string('placa', 100)->nullable()->default('0');
            $table->string('km', 100)->nullable()->default('0');
            $table->string('galones', 100)->nullable()->default('0');
            $table->string('estado_upload', 100)->nullable()->default('0');
            $table->integer('estado_orden');
        
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
        //
    }
}
