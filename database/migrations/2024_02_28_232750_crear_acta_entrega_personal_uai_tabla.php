<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * correr la migracion.
     */
    public function up(): void
    {
        Schema::create('acta_entrega_personal_uai', function (Blueprint $table) // tabla que guarda las acta de entrega
        {
            $table->id();
            $table->unsignedBigInteger('acta_entrega_id')->nullable(); // la relacion con la unidad de auditoria interna
            $table->foreign('acta_entrega_id')->references('id')->on('acta_entrega')->onDelete('cascade');
            $table->unsignedBigInteger('personal_uai_id')->nullable(); // 
            $table->foreign('personal_uai_id')->references('id')->on('personal_uai')->onDelete('cascade');

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
        Schema::drop('acta_entrega_personal_uai');
    }
};
