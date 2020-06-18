<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddNewStatsToCreatorDailyStatsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('creator_daily_stats', function (Blueprint $table) {
            $table->integer('top_count')->nullable();
            $table->decimal('invalid_percent', 4, 1)->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('creator_daily_stats', function (Blueprint $table) {
            $table->dropColumn('invalid_percent');
            $table->dropColumn('top_count');
        });
    }
}
