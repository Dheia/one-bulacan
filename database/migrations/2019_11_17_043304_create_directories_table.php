<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateDirectoriesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('directories', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('category_id');
            $table->integer('profile_id')->nullable();
            $table->string('name');
            $table->longText('logo');
            $table->string('address1');
            $table->string('address2')->nullable();
            $table->string('baranggay');
            $table->integer('location_id');
            $table->string('email');
            $table->string('telephone')->nullable();
            $table->string('mobile')->nullable();
            $table->string('facebook')->nullable();
            $table->string('twitter')->nullable();
            $table->string('instagram')->nullable();
            $table->boolean('active');
            $table->decimal('longitudde',10)->nullable();
            $table->decimal('latitude',10)->nullable();
            $table->longText('google_map_link')->nullable();
            $table->longText('slug')->nullable();
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
        Schema::dropIfExists('directories');
    }
}
