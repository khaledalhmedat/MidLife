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
    Schema::create('blood_donamtion_admin', function (Blueprint $table) {
      $table->id();
      $table->unsignedBigInteger('admin_id');
      $table->timestamps();

      $table->integer('Blood_Donation');
      $table->text('image_donation');
      $table->foreign('admin_id')->references('id')->on('admin');
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
