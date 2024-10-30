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

            $table->unsignedBigInteger('audit_activity_id');
            $table->foreign('audit_activity_id')->references('id')->on('audit_activity')->onDelete('cascade');

            $table->unsignedBigInteger('employee_id');
            $table->foreign('employee_id')->references('id')->on('employee')->onDelete('cascade');

            $table->unsignedBigInteger('designation_id');
            $table->foreign('designation_id')->references('id')->on('designations')->onDelete('cascade');

            $table->unsignedBigInteger('acretitation_id')->nullable();
            $table->foreign('acretitation_id')->references('id')->on('acreditations')->onDelete('cascade');

            $table->timestamp('created_at')->useCurrent();
            $table->timestamp('updated_at')->useCurrent();
            $table->softDeletes();
        });
    }

    public function down(): void
    {
        Schema::drop('audit_activity_employee');
    }
};
