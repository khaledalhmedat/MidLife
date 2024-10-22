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
        Schema::create('address_of_doctor', function (Blueprint $table) {
            $table->id();
            $table->string('street');
            $table->text('city');
            $table->text('governate');
            $table->text('district');
            $table->text('sub_district');
            $table->text('community');
            $table->text('details');
            $table->unsignedBigInteger('doctor_id');
            $table->timestamps();


            $table->foreign('doctor_id')->references('id')->on('doctor');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('address_of_doctor');
    }
};
