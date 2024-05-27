<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('audit_activity', function(Blueprint $table) {
            $table->id();
            $table->string('objective');
            $table->date('planning_start')->nullable();
            $table->date('planning_end')->nullable();
            $table->date('execution_start')->nullable();
            $table->date('execution_end')->nullable();
            $table->date('preliminary_start')->nullable();
            $table->date('preliminary_end')->nullable();
            $table->date('download_start')->nullable();
            $table->date('download_end')->nullable();
            $table->date('definitive_start')->nullable();
            $table->date('definitive_end')->nullable();

            $table->unsignedBigInteger('type_audit_id');
            $table->foreign('type_audit_id')->references('id')->on('type_audit');

            $table->timestamp('created_at')->useCurrent();
            $table->timestamp('updated_at')->useCurrent();
        });
    }

    public function down(): void
    {
        Schema::drop('audit_activity');
    }
};
