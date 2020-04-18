<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class DropSomeFieldsFromCreatorsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('creators', function (Blueprint $table) {
            $table->dropColumn('indicator1');
            $table->dropColumn('indicator2');
            $table->dropColumn('detail');
            $table->boolean('active')->default(true);
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
            $table->boolean('indicator1');
            $table->boolean('indicator2');
            $table->json('detail');
            $table->dropColumn('active');
        });
    }
}
