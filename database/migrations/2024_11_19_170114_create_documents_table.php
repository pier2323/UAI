<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;


class CreateDocumentsTable extends Migration
{




    public function up()
    {
        Schema::create('documents', function (Blueprint $table) {
            $table->id(); // Crea una columna 'id' como clave primaria
            $table->string('name'); // Nombre del documento
            $table->string('path'); // Ruta del documento
            $table->unsignedBigInteger('audit_activity_id'); // Agregar la columna
            $table->foreign('audit_activity_id')->references('id')->on('audit_activity')->onDelete('cascade');

            $table->timestamps(); // Timestamps para created_at y updated_at
        });
    }

    public function down()
    {
        Schema::table('documents', function (Blueprint $table) {
            $table->dropForeign(['audit_activity_id']); // Eliminar la clave foránea
            $table->dropColumn('audit_activity_id'); // Eliminar la columna
        });
    }
  
}