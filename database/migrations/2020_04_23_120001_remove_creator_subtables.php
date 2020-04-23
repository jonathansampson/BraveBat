<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class RemoveCreatorSubtables extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::dropIfExists('creator_websites');
        Schema::dropIfExists('creator_youtube');
        Schema::dropIfExists('creator_twitter');
        Schema::dropIfExists('creator_vimeo');
        Schema::dropIfExists('creator_twitch');
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        //
    }
}
