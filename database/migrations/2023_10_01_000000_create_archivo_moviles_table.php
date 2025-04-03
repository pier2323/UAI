<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateArchivoMovilesTable extends Migration
{
    public function up()
    {
        Schema::create('archivo_moviles', function (Blueprint $table) {
            $table->id(); // Primary key
            $table->string('numero_archivo')->nullable(); // Número Archivo
            $table->integer('año')->nullable(); // Año
            $table->string('codigo_auditoria')->nullable(); // Código de la Auditoría
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('archivo_moviles');
    }
}
