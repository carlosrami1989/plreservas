<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTbEmpresa extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tb_empresa', function (Blueprint $table) {
            $table->id();
            $table->string('nombre', 300)->nullable()->default('text');
            $table->string('razon_social', 300)->nullable()->default('text');
            $table->string('logos', 300)->nullable()->default('text');
            $table->string('direccion', 300)->nullable()->default('text');
            $table->string('ruc', 300)->nullable()->default('text');
            $table->string('ciudad', 300)->nullable()->default('text');
            $table->string('telefono', 300)->nullable()->default('text');
            $table->string('parroquia', 300)->nullable()->default('text');
            $table->string('email', 300)->nullable()->default('text');
            $table->string('numpat', 300)->nullable()->default('text');
            $table->string('representantel_legal', 300)->nullable()->default('text');
            $table->string('ruc_representante_legal', 300)->nullable()->default('text');
            $table->string('cargo', 300)->nullable()->default('text');
            $table->integer('usuario_ingreso');
            $table->integer('usuario_modificacion');
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
        Schema::dropIfExists('tb_empresa');
    }
}
