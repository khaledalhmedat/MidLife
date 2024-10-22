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
        Schema::create('examination_that_checked_correctly', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('doctor_id');
            $table->unsignedBigInteger('examination_id');
            $table->unsignedBigInteger('patient_id');
            $table->timestamps();
            $table->date('time');


            $table->foreign('doctor_id')->references('id')->on('doctor');
            $table->foreign('examination_id')->references('id')->on('examination');
            $table->foreign('patient_id')->references('id')->on('patient');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('examination_that_checked_correctly');
    }
};
