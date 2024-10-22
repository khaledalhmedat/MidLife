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

          $table->boolean('blood');
          $table->integer('amount');
          $table->text('type_of_blood');
          $table->unsignedBigInteger('patient_id');
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
