<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSalesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('sales', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('business_id');
            $table->boolean('status')->nullable();
            $table->boolean('emailed')->nullable();
            $table->boolean('messaged')->nullable();
            $table->boolean('notified')->nullable();
            $table->boolean('paid')->nullable();
            $table->string('payment_thru')->nullable();
            $table->string('reference_no')->nullable();
            $table->string('paid_to')->nullable();
            $table->softDeletes();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('sales');
    }
}
