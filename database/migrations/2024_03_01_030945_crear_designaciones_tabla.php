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
        Schema::create('designaciones', function(Blueprint $table) // tabla que guarda las designaciones de las actuaciones fiscales
        {
            $table->id('id');

            // ------ relaciones ------
            $table->unsignedBigInteger('personal_uai_id'); // relacion con la acta de entrega
            $table->foreign('personal_uai_id')->references('id')->on('personal_uai');
            
            $table->unsignedBigInteger('acta_entrega_id'); // relacion con la acta de entrega
            $table->foreign('acta_entrega_id')->references('id')->on('acta_entrega');
            
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
        Schema::drop('designaciones');
    }
};
