<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateBusinessCredentialsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('business_credentials', function (Blueprint $table) {
            $table->increments('id');
            $table->string('business_id')->unique();
            $table->string('business_number')->unique();
            $table->string('password');
            $table->boolean('is_first_time_login')->default(1);
            $table->rememberToken();
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
        Schema::dropIfExists('business_credentials');
    }
}
