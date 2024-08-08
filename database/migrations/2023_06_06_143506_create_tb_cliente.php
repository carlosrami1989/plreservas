<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTbCliente extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tb_cliente', function (Blueprint $table) {
            $table->id();
            $table->string('nombres', 100)->nullable()->default('text');
            $table->string('apellidos', 100)->nullable()->default('text');
            $table->string('ruc', 100)->nullable()->default('text');
            $table->string('placas', 100)->nullable()->default('text');
            $table->string('disco', 100)->nullable()->default('text');
            $table->string('km', 100)->nullable()->default('text');
            $table->string('modelo', 100)->nullable()->default('text');
            $table->string('anio', 100)->nullable()->default('text');
            $table->binary('firma_entrega');
            $table->integer('estado');
            //$table->string('cargo', 100)->nullable()->default('text');
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
        Schema::dropIfExists('tb_cliente');
    }
}
