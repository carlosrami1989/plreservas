<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class Tbguiasupload extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        //
        Schema::create('tb_guias_upload', function (Blueprint $table) {
            $table->integer('id')->autoIncrement();
            $table->string('orden', 100)->nullable()->default('0');
            $table->string('cliente', 100)->nullable()->default('0');
            $table->string('estacion', 100)->nullable()->default('0');
            $table->integer('codigo');
            $table->string('cod_estacion', 100)->nullable()->default('0');
            $table->dateTime('fecha_emision');
            $table->dateTime('fecha_vencimiento');
            $table->dateTime('fecha_venta');
            $table->string('volumen', 100)->nullable()->default('0');
            $table->string('producto', 100)->nullable()->default('0');
            $table->double('valor', 15, 8);
            $table->string('factura', 100)->nullable()->default('0');
            $table->string('autorizacion', 100)->nullable()->default('0');
            $table->dateTime('fecha_autorizacion');
            $table->string('clave_acceso', 100)->nullable()->default('0');
            $table->string('correo', 100)->nullable()->default('0');
            $table->string('identificacion', 100)->nullable()->default('0');
 
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
