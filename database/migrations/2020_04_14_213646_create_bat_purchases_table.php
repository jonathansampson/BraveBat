<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBatPurchasesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('bat_purchases', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            $table->date('transaction_date');
            $table->integer('transaction_amount');
            $table->string('transaction_record')->index();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('bat_purchases');
    }
}
