<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAdsSetsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('ads_sets', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            $table->string('value');
            $table->smallInteger('per_day');
            $table->smallInteger('per_week');
            $table->smallInteger('per_month');
            $table->smallInteger('total_max');
            $table->string('brave_id');

            $table->unsignedBigInteger('ads_campaign_id');
            $table->foreign('ads_campaign_id')->references('id')->on('ads_campaigns')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('ads_sets');
    }
}
