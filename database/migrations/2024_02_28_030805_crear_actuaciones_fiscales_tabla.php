<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * correr la migracion.
     */
    public function up(): void
    {
        Schema::create('actuaciones_fiscales', function(Blueprint $table) // tabla que guarda las actuaciones fiscales
        {
            $table->id();
            $table->string('objetivo');
            $table->date('planning_start')->nullable();
            $table->date('planning_end')->nullable();
            $table->date('execution_start')->nullable();
            $table->date('execution_end')->nullable();
            $table->date('preliminary_start')->nullable();
            $table->date('preliminary_end')->nullable();
            $table->date('download_start')->nullable();
            $table->date('download_end')->nullable();
            $table->date('definitive_start')->nullable();
            $table->date('definitive_end')->nullable();

            // ------ relaciones ------
            $table->unsignedBigInteger('tipo_auditoria_id');
            $table->foreign('tipo_auditoria_id')->references('id')->on('tipo_auditoria');

            // ------ fecha en que se agrega una fila y se modifica ------
            $table->timestamp('created_at')->useCurrent();
            $table->timestamp('updated_at')->useCurrent();
        });
    }

    /**
     * revertir la migracion.
     */
    public function down(): void
    {
        Schema::drop('actuaciones_fiscales');
    }
};
