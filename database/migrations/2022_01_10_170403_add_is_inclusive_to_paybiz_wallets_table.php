<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddIsInclusiveToPaybizWalletsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('paybiz_wallets', function (Blueprint $table) {
            $table->boolean('is_inclusive')->nullable()->default(0)->after('biz_wallet_id');
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
            $table->dropColumn('is_inclusive');
        });
    }
}
