<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class UpdateRemisionDefinitivosTableAddHallazgo extends Migration
{
    public function up()
    {
        Schema::table('remision_definitivos', function (Blueprint $table) {
            $table->text('hallazgo')->nullable(); // Agregar la columna hallazgo
        });
    }

    public function down()
    {
        Schema::table('remision_definitivos', function (Blueprint $table) {
            $table->dropColumn('hallazgo'); // Eliminar la columna hallazgo si se revierte la migración
        });
    }
}
