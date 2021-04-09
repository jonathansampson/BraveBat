<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddAdsAdvertiserIdToAdsCampaignsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('ads_campaigns', function (Blueprint $table) {
            $table->bigInteger('ads_advertiser_id')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('ads_campaigns', function (Blueprint $table) {
            $table->dropColumn('ads_advertiser_id');
        });
    }
}
