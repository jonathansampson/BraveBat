<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAdsSetOsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('ads_set_os', function (Blueprint $table) {
            $table->bigInteger('ads_set_id');
            $table->bigInteger('ads_os_id');
            $table->primary(['ads_set_id', 'ads_os_id']);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('ads_set_os');
    }
}
