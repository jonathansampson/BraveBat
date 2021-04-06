<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAdsCreativesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('ads_creatives', function (Blueprint $table) {
            $table->id();
            $table->timestamps();

            $table->string('type');
            $table->string('name');
            $table->smallInteger('version');
            $table->string('platform');
            $table->string('notification_body')->nullable();
            $table->string('notification_title')->nullable();
            $table->text('notification_target_url')->nullable();

            $table->text('page_logo_alt')->nullable();
            $table->string('page_image_url')->nullable();
            $table->string('page_company_name')->nullable();
            $table->string('page_destination_url')->nullable();
            $table->string('brave_id')->unique();

            $table->unsignedBigInteger('ads_set_id');
            $table->foreign('ads_set_id')->references('id')->on('ads_sets')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('ads_creatives');
    }
}
