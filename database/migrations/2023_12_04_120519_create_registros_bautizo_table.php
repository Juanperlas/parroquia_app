<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateRegistrosBautizoTable extends Migration
{
    public function up()
    {
        Schema::create('registro_bautizos', function (Blueprint $table) {
            $table->id('numero_registro');
            $table->string('nombre');
            $table->string('padre');
            $table->string('madre');
            $table->string('padrino');
            $table->string('madrina');
            $table->date('fecha_bautizo');
            $table->string('lugar_bautizo');
            $table->string('sacerdote');
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('registros_bautizo');
    }
}
