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
        Schema::create('acta_entrega', function(Blueprint $table) // tabla que guarda las acta de entrega
        {
            $table->id();
            // $table->date('gestion_inicio');
            // $table->date('gestion_fin'); //
            
            $table->date('suscripcion')->nullable(); // fecha de suscripcion
            $table->date('recepcion_uai')->nullable(); // fecha de recepcion por parte de la uai

            // ------ relaciones ------
            $table->unsignedBigInteger('actuacion_fiscal_id');
            $table->foreign('actuacion_fiscal_id')->references('id')->on('actuaciones_fiscales');
            
            $table->unsignedBigInteger('personal_entrega_id'); // la relacion con la persona que entrega
            $table->foreign('personal_entrega_id')->references('id')->on('personal_entrega');
            
            $table->unsignedBigInteger('personal_recibe_id'); // la relacion con la persona que recibe
            $table->foreign('personal_recibe_id')->references('id')->on('personal_recibe');

            $table->unsignedBigInteger('personal_uai_id')->nullable(); // la relacion con la unidad de auditoria interna
            $table->foreign('personal_uai_id')->references('id')->on('personal_uai');
            
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
        Schema::drop('acta_entrega');
    }
};
