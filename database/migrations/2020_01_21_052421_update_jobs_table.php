<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class UpdateJobsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('jobs', function (Blueprint $table) {
            $table->integer('business_id')->nullable()->change();
            $table->integer('job_category_id')->nullable()->change();
            $table->string('position')->nullable()->change();
            $table->longtext('description')->nullable()->change();
            $table->longtext('requirement')->nullable()->change();
            $table->longtext('qualification')->nullable()->change();
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
            $table->integer('business_id')->change();
            $table->integer('job_category_id')->change();
            $table->string('position')->change();
            $table->longtext('description')->change();
            $table->longtext('requirement')->change();
            $table->longtext('qualification')->change();
        });
    }
}
