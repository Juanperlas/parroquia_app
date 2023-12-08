<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateRegistrosEliminadosTable extends Migration
{
    public function up()
    {
        Schema::create('registros_eliminados', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('numero_registro');
            $table->foreign('numero_registro')->references('numero_registro')->on('registro_bautizos');
            $table->timestamp('fecha_eliminacion');
            $table->text('justificacion');
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('registros_eliminados');
    }
}
