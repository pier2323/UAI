<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class UpdateRemisionDefinitivosTable extends Migration
{
    public function up()
    {
        Schema::table('remision_definitivos', function (Blueprint $table) {
            $table->text('objective')->nullable()->change(); // Cambiar a text para permitir más caracteres
        });
    }

    public function down()
    {
        Schema::table('remision_definitivos', function (Blueprint $table) {
            $table->string('objective')->nullable()->change(); // Revertir a string si es necesario
        });
    }
}
