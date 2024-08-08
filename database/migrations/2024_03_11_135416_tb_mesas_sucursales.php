<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class TbMesasSucursales extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        //
        Schema::create('tb_sucursal_mesa', function (Blueprint $table) {
            $table->integer('id')->autoIncrement();
            $table->integer('id_empresa');
            $table->integer('id_sucursal');
            $table->string('descripcion', 100)->nullable()->default('0');
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
