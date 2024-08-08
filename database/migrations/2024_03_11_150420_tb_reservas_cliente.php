<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class TbReservasCliente extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        //
        Schema::create('tb_resrvaciones', function (Blueprint $table) {
            $table->integer('id')->autoIncrement();
            $table->integer('id_empresa');
            $table->integer('id_sucursal');
            $table->integer('id_mesa');
            $table->integer('id_cliente_reserva');
            $table->dateTime('fecha_reserva');
            $table->string('hora_reserva');
               $table->time('hora_reserva_t');
            $table->string('descripcion', 100)->nullable()->default('0');
            $table->string('celular');
            $table->integer('pago');
            $table->string('transaccion');
            $table->string('src', 100)->nullable()->default('0');
            $table->double('valor', 15, 8);
            $table->string('color', 100)->nullable()->default('0');
            $table->string('icono', 100)->nullable()->default('0');            
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
