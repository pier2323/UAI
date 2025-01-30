<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMemoTable extends Migration
{
    public function up()
    {
        Schema::create('memo', function (Blueprint $table) {
            $table->id();
            $table->text('descripcion')->nullable();
            $table->text('unidad_responsable')->nullable();
            $table->string('tipo_hallazgo')->nullable(); // Campo para el tipo de hallazgo
            $table->string('input_tipo1')->nullable();   // Campo para el input de tipo 1
            $table->decimal('input_tipo2')->nullable();  // Campo para el input de tipo 2
            $table->text('input_tipo3')->nullable();     // Campo para el input de tipo 3
            $table->string('par')->nullable();           // Campo para el Par
            $table->string('gerencia')->nullable();      // Campo para la Gerencia
            $table->date('fecha1')->nullable();          // Campo para Fecha 1
            $table->date('fecha2')->nullable();          // Campo para Fecha 2
            $table->text('conclusion')->nullable();      // Campo para la conclusión
            $table->text('recomendaciones')->nullable();  // Campo para las recomendaciones
            
            // Campos relacionados con la auditoría
            $table->text('auditoria')->nullable();     // Campo para auditoría
            $table->text('riesgo')->nullable();        // Campo para riesgo
            $table->text('unidad_responsable_auditoria')->nullable(); // Campo para unidad responsable de auditoría
            $table->text('transferido_a')->nullable(); // Campo para transferido a
           // Nuevo campo para almacenar las fechas de reporte
           $table->text('fechas_reporte')->nullable(); // Campo para las fechas de reporte
            // Campo para los titulos del cuadro 
           $table->text(  'titulo_cuadro1')->nullable();
           $table->text(  'titulo_cuadro2')->nullable();
           $table->integer('anio')->nullable(); // Campo para el año

            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('memo');
    }
}