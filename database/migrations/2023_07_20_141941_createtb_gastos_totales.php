<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatetbGastosTotales extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        //
        Schema::create('tb_gastos_totales', function (Blueprint $table) {
            $table->integer('id')->autoIncrement();
            $table->integer('mes');
            $table->integer('anio');
            $table->integer('id_estacion');
            $table->string('estacion', 5000)->nullable()->default('text');
            $table->double('dc_valhab', 15, 8);
            $table->double('dc_valdeb', 15, 8);
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
