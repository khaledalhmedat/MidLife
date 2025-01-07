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
    Schema::create('donation_response', function (Blueprint $table) {
      $table->id();
      $table->unsignedBigInteger('blood_donation_id');
      $table->string('donation_receipt');
      $table->timestamps();

      $table->foreign('blood_donation_id')->references('id')->on('blood_donation')->onDelete('cascade');
    });
  }

  /**
   * Reverse the migrations.
   */
  public function down(): void
  {
    Schema::dropIfExists('blood_donamtion_admin');
  }
};
