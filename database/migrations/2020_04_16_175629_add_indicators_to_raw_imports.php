<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddIndicatorsToRawImports extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('raw_import', function (Blueprint $table) {
            $table->boolean('indicator1');
            $table->boolean('indicator2');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('raw_import', function (Blueprint $table) {
            $table->dropColumn('indicator2');
            $table->dropColumn('indicator1');
        });
    }
}
