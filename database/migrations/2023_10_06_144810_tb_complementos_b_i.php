<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class TbComplementosBI extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        //
        Schema::create('tb_complementos_bi', function (Blueprint $table) {
            $table->integer('id')->autoIncrement();
            $table->string('descripcion', 100)->nullable()->default('0');
            $table->double('valor', 15, 8);
            $table->string('color', 100)->nullable()->default('0');
            $table->string('icono', 100)->nullable()->default('0');
            $table->string('estacion', 100)->nullable()->default('0');
            $table->string('mes', 100)->nullable()->default('0');
           
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
