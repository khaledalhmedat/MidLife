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
      Schema::create('patient', function (Blueprint $table) {
          $table->id();
          $table->string('full_name');
          $table->string('martial_status');
          $table->text('national_number')->unique();
          $table->text('phone')->unique();
          $table->text('city');
          $table->text('street');
          $table->text('password');
          $table->boolean('is_approved')->default(true);
          $table->rememberToken();
          $table->timestamps();
      });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
            Schema::dropIfExists('patient');
    }
};
