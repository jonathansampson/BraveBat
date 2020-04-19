<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class UpdateCreatorYoutubeTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('creator_youtube', function (Blueprint $table) {
            $table->dropColumn('follower');
            $table->string('description', 1000)->nullable();
            $table->string('thumbnail', 1000)->nullable();
            $table->bigInteger('view_count')->nullable();
            $table->bigInteger('subscriber_count')->nullable();
            $table->integer('video_count')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('creator_youtube', function (Blueprint $table) {
            $table->integer('follower');
            $table->dropColumn('description');
            $table->dropColumn('thumbnail');
            $table->dropColumn('view_count');
            $table->dropColumn('subscriber_count');
            $table->dropColumn('video_count');
        });
    }
}
