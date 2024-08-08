<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatetbEstaciones extends Migration
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
         Schema::create('tb_estaciones', function (Blueprint $table) {
            $table->integer('id');
            $table->string('descripcion', 100)->nullable()->default('text');
            $table->string('direccion', 100)->nullable()->default('text');
            $table->string('latitud', 100)->nullable()->default('text');
            $table->string('longitud', 100)->nullable()->default('text');
            $table->string('telefono', 100)->nullable()->default('text');
            $table->double('galones', 15, 8);
            $table->double('total', 15, 8);
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
