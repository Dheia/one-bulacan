<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddColumnsToJobsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('jobs', function (Blueprint $table) {
            $table->integer('quantity')->nullable()->after('qualification');
            $table->string('local')->nullable()->after('quantity');
            $table->string('contact_person')->nullable()->after('local');
            $table->string('contact_number')->nullable()->after('contact_person');
            $table->boolean('registered')->nullable()->after('contact_number');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('jobs', function (Blueprint $table) {
            $table->dropColumn('quantity');
            $table->dropColumn('local');
            $table->dropColumn('contact_person');
            $table->dropColumn('contact_number');
            $table->dropColumn('registered');
        });
    }
}
