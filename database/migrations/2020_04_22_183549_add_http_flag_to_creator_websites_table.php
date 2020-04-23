<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddHttpFlagToCreatorWebsitesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('creator_websites', function (Blueprint $table) {
            $table->boolean('https')->default(true)->after('alexa_ranking');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('creator_websites', function (Blueprint $table) {
            $table->dropColumn('https');
        });
    }
}
