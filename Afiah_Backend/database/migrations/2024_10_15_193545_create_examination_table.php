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
        Schema::create('examination', function (Blueprint $table) {
            $table->id();
            $table->text('description_of_status')->nullable();
            $table->text('report');
            $table->text('notes')->nullable();
            $table->unsignedBigInteger('patient_id');
            $table->foreign('patient_id')->references('id')->on('patient');
            $table->unsignedBigInteger('doctor_id')->nullable();
            $table->foreign('doctor_id')->references('id')->on('doctor');
            $table->date('time')->nullable();
            $table->string('city');
            $table->unsignedBigInteger('specification_id');
            $table->string('sick_history')->nullable();
            $table->string('surgical_history')->nullable();
            $table->string('medications_taken')->nullable();
            $table->string('history_of_drug_allergy')->nullable();
            $table->timestamps();

            $table->foreign('specification_id')->references('id')->on('specification');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('examination');
    }
};
