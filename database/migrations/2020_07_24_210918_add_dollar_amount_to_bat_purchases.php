<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddDollarAmountToBatPurchases extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('bat_purchases', function (Blueprint $table) {
            $table->decimal('dollar_amount', 10, 2)->after('transaction_amount')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('bat_purchases', function (Blueprint $table) {
            $table->dropColumn('dollar_amount');
        });
    }
}
