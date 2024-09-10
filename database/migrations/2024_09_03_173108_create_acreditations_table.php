<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('acreditations', function (Blueprint $table) {
            $table->id();
            $table->date('date_release');
            $table->string('path_document')->nullable();
                       
            $table->unsignedBigInteger('pivot_id');
            $table->foreign('pivot_id')->references('id')->on('audit_activity_employee')->onDelete('cascade');

            $table->timestamp('created_at')->useCurrent();
            $table->timestamp('updated_at')->useCurrent();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('acreditations');
    }
};
