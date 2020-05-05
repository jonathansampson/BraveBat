<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCreatorDailyStatsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('creator_daily_stats', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            $table->date('record_date');
            $table->string('channel')->index();
            $table->integer('total');
            $table->integer('addition');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('creator_daily_stats');
    }
}
