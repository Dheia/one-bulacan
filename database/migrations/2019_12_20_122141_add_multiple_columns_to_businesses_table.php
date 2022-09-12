<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddMultipleColumnsToBusinessesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('businesses', function (Blueprint $table) {
            $table->string('slug')->nullable()->after('name');
            $table->boolean('verified')->nullable()->after('status');
            $table->boolean('featured')->nullable()->after('verified');
            $table->boolean('active')->nullable()->after('featured');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('businesses', function (Blueprint $table) {
            $table->dropColumn('verified');
            $table->dropColumn('verified');
            $table->dropColumn('featured');
            $table->dropColumn('active');
        });
    }
}
