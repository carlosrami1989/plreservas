<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatetbGastosEDS extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        //
        Schema::create('tb_gastos', function (Blueprint $table) {
            $table->integer('id')->autoIncrement();
            $table->integer('mes');
            $table->integer('anio');
            $table->integer('id_estacion');
            $table->integer('id_estacion_obrero');
            $table->string('estacion', 5000)->nullable()->default('text');
            $table->string('pc_codcta', 5000)->nullable()->default('text');
            $table->string('pc_nomcta', 5000)->nullable()->default('text');
            $table->string('cc_concepto', 100)->nullable()->default('text');
            $table->string('cc_fecha', 100)->nullable()->default('text');
            $table->string('cc_fechagra', 100)->nullable()->default('text');
            $table->string('dc_glosa', 100)->nullable()->default('text');
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
