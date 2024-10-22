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
        Schema::create('doctor', function (Blueprint $table) {
            $table->id();
            $table->string('full_name');
            $table->text('phone')->unique();
            $table->text('national_number')->unique();
            $table->string('password');
            $table->boolean('is_approved')->default(true);
            $table->timestamps();

            $table->unsignedBigInteger('specification_id');

            $table->foreign('specification_id')->references('id')->on('specification');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('doctor');
    }
};
