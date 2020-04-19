<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCreatorVimeoTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('creator_vimeo', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            $table->string('vimeo_id')->nullable();
            $table->string('name')->nullable();
            $table->string('display_name')->nullable();
            $table->string('description', 1000)->nullable();
            $table->string('thumbnail', 1000)->nullable();
            $table->integer('follower_count')->nullable();
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
        Schema::dropIfExists('creator_vimeo');
    }
}
