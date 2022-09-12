<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class ModifyColumnsOfBusinessCredentialsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('business_credentials', function (Blueprint $table) {
            $table->dropColumn('business_id');
            $table->dropColumn('business_number');
            $table->integer('business_owner_id')->after('id');
            $table->string('email')->after('business_owner_id');
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('business_credentials', function (Blueprint $table) {
            $table->string('business_id')->unique()->after('id');
            $table->string('business_number')->unique()->after('business_id');
            $table->dropColumn('business_owner_id');
            $table->dropColumn('email');
            $table->dropColumn('deleted_at');
        });
    }
}
