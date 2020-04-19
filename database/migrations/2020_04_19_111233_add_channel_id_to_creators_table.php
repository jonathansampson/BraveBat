<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddChannelIdToCreatorsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('creators', function (Blueprint $table) {
            $table->string('channel_id')->after('channel')->nullable();
            $table->string('channel')->nullable()->change();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('creators', function (Blueprint $table) {
            $table->dropColumn('channel_id');
        });
    }
}
