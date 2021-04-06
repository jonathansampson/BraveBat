<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAdsCampaignsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('ads_campaigns', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            $table->decimal('ptr', 8, 4);
            $table->datetime('start_at');
            $table->datetime('end_at');
            $table->smallInteger('daily_cap');
            $table->smallInteger('priority');
            $table->string('advertiser_id');
            $table->json('response');
            $table->string('brave_id')->unique();

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('ads_campaigns');
    }
}
