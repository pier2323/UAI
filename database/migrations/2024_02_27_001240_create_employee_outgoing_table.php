<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('employee_outgoing', function(Blueprint $table) {
            $table->id();
            $table->string('first_name');
            $table->string('second_name')->nullable();
            $table->string('first_surname');
            $table->string('second_surname')->nullable();
            $table->string('gmail')->nullable();
            $table->string('email_cantv')->nullable();
            $table->string('address')->nullable();
            $table->string('phone')->nullable();
            $table->string('profile_photo')->nullable();
            $table->integer('p00')->unique();
            $table->integer('personal_id')->unique();
            $table->string('job_title');

            $table->unsignedBigInteger('departament_id');
            $table->foreign('departament_id')->references('id')->on('departament');

            $table->timestamp('created_at')->useCurrent();
            $table->timestamp('updated_at')->useCurrent();
        });
    }

    public function down(): void
    {
        Schema::drop('employee_outgoing');

    }
};
