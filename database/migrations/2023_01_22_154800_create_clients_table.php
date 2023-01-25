<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('clients', function (Blueprint $table) {
            $table->id();

            $table->string('name');
            $table->string('email')->unique();
            $table->string('phone')->unique();
            $table->string('phoneIsVerified');
            // optional field
            $table->string('pet_name')->nullable();
            $table->string('pet_breed')->nullable();
            $table->string('pet_weight')->nullable();
            $table->integer('pet_age_month')->nullable();
            $table->integer('pet_age_year')->nullable();
            // vet data -> point to vet data
            $table->foreignId('vet_id');

            // otp and codes and activated status
            $table->dateTime('active_date')->nullable();
            $table->dateTime('active_status')->nullable();

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('clients');
    }
};
