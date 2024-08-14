<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration 
{
    public function up(): void
    {
        Schema::create('audit_activity_employee', function (Blueprint $table) {
            $table->id();

            $table->string('role');

            $table->unsignedBigInteger('audit_activity_id')->nullable(); 
            $table->foreign('audit_activity_id')->references('id')->on('audit_activity')->onDelete('cascade');

            $table->unsignedBigInteger('employee_id')->nullable();
            $table->foreign('employee_id')->references('id')->on('employee')->onDelete('cascade');

            $table->timestamp('created_at')->useCurrent();
            $table->timestamp('updated_at')->useCurrent();
        });
    }

    public function down(): void
    {
        Schema::drop('audit_activity_employee');
    }
};
