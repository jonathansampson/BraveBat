<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddNewFieldsToCreatorsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('creators', function (Blueprint $table) {
            $table->boolean('valid')->default(true);
            $table->string('link')->nullable();
            $table->string('display_name')->nullable();
            $table->string('description', 1000)->nullable();
            $table->string('thumbnail')->nullable();
            $table->integer('alexa_ranking')->nullable();
            $table->string('screenshot')->nullable();
            $table->integer('follower_count')->nullable();
            $table->bigInteger('view_count')->nullable();
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
        Schema::table('creators', function (Blueprint $table) {
            //
        });
    }
}
