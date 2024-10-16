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
            $table->integer('public_id')->nullable();
            $table->boolean('is_poa')->nullable()->default(false);
            $table->string('year', length: 4)->default('2024');
            $table->string('description')->nullable();
            $table->string('objective', length: 5000)->nullable();
            $table->string('month_start')->nullable();
            $table->string('month_end')->nullable();

            { // todo planning 
                $table->date('planning_start')->nullable();
                $table->date('planning_end')->nullable();         
                $table->integer('planning_days')->nullable();

                $table->date('execution_start')->nullable();
                $table->date('execution_end')->nullable();          
                $table->integer('execution_days')->nullable();

                $table->date('preliminary_start')->nullable();
                $table->date('preliminary_end')->nullable();
                $table->integer('preliminary_days')->nullable();

                $table->date('download_start')->nullable();
                $table->date('download_end')->nullable();         
                $table->integer('download_days')->nullable();
                
                $table->date('definitive_start')->nullable();
                $table->date('definitive_end')->nullable();           
                $table->integer('definitive_days')->nullable();
            }

            $table->unsignedBigInteger('type_audit_id')->nullable();
            $table->foreign('type_audit_id')->references('id')->on('type_audit');

            $table->unsignedBigInteger('area_id')->nullable();
            $table->foreign('area_id')->references('id')->on('areas');
            
            $table->unsignedBigInteger('uai_id')->nullable();
            $table->foreign('uai_id')->references('id')->on('uai');
            
            $table->unsignedBigInteger('departament_id')->nullable();
            $table->foreign('departament_id')->references('id')->on('departament');


            $table->timestamp('created_at')->useCurrent();
            $table->timestamp('updated_at')->useCurrent();
        });
    }

    public function down(): void
    {
        Schema::drop('audit_activity');
    }
};
