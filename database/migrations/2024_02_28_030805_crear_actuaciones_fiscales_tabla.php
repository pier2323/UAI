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
            $table->date('inicio');
            $table->date('fin');

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
