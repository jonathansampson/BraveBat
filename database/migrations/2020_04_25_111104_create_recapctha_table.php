<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateRecapcthaTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('recaptcha', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            $table->boolean('success');
            $table->decimal('score', 2, 1)->nullable();
            $table->string('action')->nullable();
            $table->string('email')->nullable();
            $table->json('error_codes')->nullable();
        });
    }



    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('recaptcha');
    }
}
