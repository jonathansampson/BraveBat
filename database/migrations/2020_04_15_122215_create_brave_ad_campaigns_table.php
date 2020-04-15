<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBraveAdCampaignsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('brave_ad_campaigns', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            $table->date('record_date');
            $table->string('country')->index();
            $table->integer('campaigns');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('brave_ad_campaigns');
    }
}
