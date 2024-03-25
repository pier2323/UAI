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
        Schema::create('personal_uai', function(Blueprint $table) // tabla que guarda el personal de la uai
        {
            $table->id();            
            $table->string('primer_nombre');
            $table->string('segundo_nombre')->nullable();
            $table->string('primer_apellido');
            $table->string('segundo_apellido')->nullable();
            $table->string('gmail')->nullable();
            $table->string('email_cantv')->nullable();
            $table->string('telefono')->nullable();
            $table->binary('foto_perfil')->nullable();
            $table->integer('p00')->unique();
            $table->integer('cedula')->unique();
            
            // ------ relaciones ------
            $table->unsignedBigInteger('cargo_id');
            $table->foreign('cargo_id')->references('id')->on('cargo');
            
            $table->unsignedBigInteger('uai_id'); // adscripcion a la coordinacion | gerencia | despacho, de la uai
            $table->foreign('uai_id')->references('id')->on('uai');

            $table->unsignedBigInteger('user_id'); // relacion uno a uno con la tabla users
            $table->foreign('user_id')->references('id')->on('users');

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
        Schema::drop('personal_uai');
    }
};
