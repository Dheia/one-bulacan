<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\Schema;

class CreateBusinessCouponsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('business_coupons', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedBigInteger('business_id');
            $table->string('code')->unique();
            $table->string('title')->nullable();
            $table->longText('description')->nullable();
            $table->integer('quantity')->nullable();
            $table->longText('secret');
            $table->dateTime('start_at');
            $table->dateTime('end_at');
            $table->timestamps();
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
        Schema::dropIfExists('business_coupons');
    }
}
