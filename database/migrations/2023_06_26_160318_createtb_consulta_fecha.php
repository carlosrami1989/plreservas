<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatetbConsultaFecha extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        //
         //
         Schema::create('tb_consulta_dia', function (Blueprint $table) {
            $table->integer('id');
            $table->dateTime('dia');
            $table->string('descripcion', 100)->nullable()->default('text');
            $table->double('galones', 15, 8);
            $table->double('total', 15, 8);
            $table->integer('estacion');
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
