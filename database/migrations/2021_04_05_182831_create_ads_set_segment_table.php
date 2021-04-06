<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAdsSetSegmentTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('ads_set_segment', function (Blueprint $table) {
            $table->bigInteger('ads_set_id');
            $table->bigInteger('ads_segment_id');
            $table->primary(['ads_set_id', 'ads_segment_id']);

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('ads_set_segment');
    }
}
