<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddMinimumAmountToPaybizWalletsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('paybiz_wallets', function (Blueprint $table) {
            $table->string('minimum_amount')->after('biz_wallet_id')->default(0);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('paybiz_wallets', function (Blueprint $table) {
            $table->dropColumn('minimum_amount');
        });
    }
}
