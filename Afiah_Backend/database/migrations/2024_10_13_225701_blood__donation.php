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
      Schema::create('Blood_Donation', function (Blueprint $table) {
          $table->id();

          $table->integer('units_needed');
          $table->string('status')->default('pending');
          $table->text('blood_type');
          $table->unsignedBigInteger('patient_id');
          $table->text('medical_report');
          $table->string('city');
          $table->timestamps();


          $table->foreign('patient_id')->references('id')->on('patient');

      });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
            Schema::dropIfExists('Blood_Donation');
    }
};
