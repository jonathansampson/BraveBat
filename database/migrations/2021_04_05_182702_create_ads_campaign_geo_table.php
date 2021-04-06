<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAdsCampaignGeoTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('ads_campaign_geo', function (Blueprint $table) {
            $table->bigInteger('ads_campaign_id');
            $table->bigInteger('ads_geo_id');
            $table->primary(['ads_campaign_id', 'ads_geo_id']);

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('ads_campaign_geo');
    }
}
