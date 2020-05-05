<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddIndexToSortFieldsOnCreatorsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('creators', function (Blueprint $table) {
            $table->integer('follower_count')->index()->change();
            $table->integer('alexa_ranking')->index()->change();
            $table->integer('video_count')->index()->change();
            $table->integer('repo_count')->index()->change();
            $table->bigInteger('view_count')->index()->change();
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
            //
        });
    }
}
