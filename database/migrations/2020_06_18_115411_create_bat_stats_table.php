<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBatStatsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('bat_stats', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            $table->integer('holders_count');
            $table->integer('holders_add')->nullable();
            $table->decimal('price', 10, 4);
            $table->bigInteger('volume');
            $table->bigInteger('market_cap');
            $table->date('record_date');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('bat_stats');
    }
}
