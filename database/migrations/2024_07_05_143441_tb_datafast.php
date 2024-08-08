<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class TbDatafast extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        //
        Schema::create('tb_datafast', function (Blueprint $table) {
            $table->integer('id')->autoIncrement();
            $table->string('ndc', 500)->nullable()->default('0');
            $table->string('codigo', 500)->nullable()->default('0');
            $table->string('mensaje', 500)->nullable()->default('0');
            $table->string('holder', 500)->nullable()->default('0');            
            $table->string('des_campo1', 500)->nullable()->default('0');   
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
