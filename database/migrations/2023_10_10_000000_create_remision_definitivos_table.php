<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateRemisionDefinitivosTable extends Migration
{
    public function up()
    {
        Schema::create('remision_definitivos', function (Blueprint $table) {
            $table->id();
            $table->string('codigo');
            $table->string('para');
            $table->text('objective')->nullable(); // Cambiar a text para permitir más caracteres
            $table->text('hallazgos')->nullable(); // Agregar el campo hallazgos
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('remision_definitivos');
    }
}
