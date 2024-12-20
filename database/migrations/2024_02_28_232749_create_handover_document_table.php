<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('handover_document', function(Blueprint $table) {
            $table->id();

            $table->date('start')->nullable();
            $table->date('cease')->nullable();
            $table->date('subscription')->nullable();
            $table->date('delivery_uai')->nullable();
            $table->string('departament_affiliation')->nullable();
            $table->string('departament')->nullable();
            $table->json('hallazgo')->nullable();
            $table->softDeletes();

            $table->unsignedBigInteger('employee_outgoing_id')->nullable();
            $table->foreign('employee_outgoing_id')->references('id')->on('employee_outgoing');

            $table->unsignedBigInteger('employee_incoming_id')->nullable();
            $table->foreign('employee_incoming_id')->references('id')->on('employee_incoming');

            $table->unsignedBigInteger('audit_activity_id')->unique()->nullable();
            $table->foreign('audit_activity_id')->references('id')->on('audit_activity');

            $table->timestamp('created_at')->useCurrent();
            $table->timestamp('updated_at')->useCurrent();
        });
    }

    public function down(): void
    {
        Schema::drop('handoverDocument');
    }
};
