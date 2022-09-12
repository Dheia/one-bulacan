<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateBusinessesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('businesses', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name');
            $table->string('address1')->nullable();
            $table->string('address2')->nullable();
            $table->string('location_id');
            $table->string('baranggay_id');
            $table->longtext('logo')->nullable();
            $table->string('telephone')->nullable();
            $table->string('mobile')->nullable();
            $table->string('email');
            $table->string('website')->nullable();
            $table->string('contact_person');
            $table->string('nature')->nullable();
            $table->string('facebook')->nullable();
            $table->string('twitter')->nullable();
            $table->string('instagram')->nullable();
            $table->longtext('history')->nullable();
            $table->longtext('description')->nullable();
            $table->longtext('about')->nullable();
            $table->longtext('purpose')->nullable();
            $table->longtext('vission')->nullable();
            $table->longtext('mission')->nullable();
            $table->longtext('core_values')->nullable();
            $table->longtext('goals')->nullable();
            $table->longtext('key_process')->nullable();
            $table->longtext('scope_of_work')->nullable();
            $table->longtext('product_services')->nullable();
            $table->longtext('image_gallery')->nullable();
            $table->string('longitude')->nullable();
            $table->string('latitude')->nullable();
            $table->longtext('ad_promotion')->nullable();
            $table->longtext('branches')->nullable();
            $table->boolean('status')->nullable();
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
        Schema::dropIfExists('businesses');
    }
}
