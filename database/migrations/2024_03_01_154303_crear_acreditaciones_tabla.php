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
        Schema::create('acreditaciones', function(Blueprint $table) // tabla que guarda los diferentes tipos de auditoria
        {
            $table->id('id');
            $table->binary('archivo');

            // ------ relaciones ------
            $table->unsignedBigInteger('personal_uai_id'); // relacion con la acta de entrega
            $table->foreign('personal_uai_id')->references('id')->on('personal_uai');
            
            $table->unsignedBigInteger('acta_entrega_id'); // relacion con la acta de entrega
            $table->foreign('acta_entrega_id')->references('id')->on('acta_entrega');
            
            // ------ fecha en que se agrega una fila y se modifica ------
            $table->timestamp('updated_at')->useCurrent();
            $table->timestamp('created_at')->useCurrent();
        });
    }

    /**
     * revertir la migracion.
     */
    public function down(): void
    {
        Schema::drop('acreditaciones');

    }
};
