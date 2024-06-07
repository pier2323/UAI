<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('accreditation', function(Blueprint $table) {
            $table->id('id');
            $table->binary('archivo');

            $table->unsignedBigInteger('employee_id');
            $table->foreign('employee_id')->references('id')->on('employee');
            
            $table->unsignedBigInteger('handover_document_id');
            $table->foreign('handover_document_id')->references('id')->on('handover_document');
            
            $table->timestamp('updated_at')->useCurrent();
            $table->timestamp('created_at')->useCurrent();
        });
    }

    public function down(): void
    {
        Schema::drop('accreditation');

    }
};
