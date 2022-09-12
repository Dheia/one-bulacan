<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePaynamicsPaymentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('paynamics_payments', function (Blueprint $table) {
            $table->id();
            $table->foreignId('payment_method_id')
                ->constrained()
                ->onUpdate('cascade')
                ->onDelete('cascade');

            $table->bigInteger('paymentable_id');
            $table->string('paymentable_type');

            $table->string('firstname');
            $table->string('lastname');
            $table->string('email');
            $table->string('mobile');
            $table->string('address')->nullable();
            $table->longText('description')->nullable();

            $table->string('amount')->nullable();
            $table->string('fee')->nullable();

            $table->string('request_id');
            $table->string('response_id')->nullable();
            $table->string('merchant_id')->nullable();
            $table->string('expiry_limit')->nullable();
            $table->longText('direct_otc_info')->nullable();
            $table->longText('payment_action_info')->nullable();
            $table->longText('response')->nullable();

            $table->datetime('timestamp')->nullable();
            $table->string('rebill_id')->nullable();
            $table->longText('signature')->nullable();
            $table->string('response_code')->nullable();
            $table->longText('response_message')->nullable();
            $table->longText('response_advise')->nullable();
            $table->longText('settlement_info_details')->nullable();

            $table->boolean('mail_sent')->default(0);
            $table->string('status');
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
        Schema::dropIfExists('paynamics_payments');
    }
}
