<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateVenuesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('venues', function (Blueprint $table) {
            $table->increments('id');
            $table->string('slug');
            $table->string('name');
            $table->string('address');
            $table->integer('lat')->nullable();
            $table->integer('long')->nullable();
            $table->string('website')->nullable();
            $table->string('age')->nullable();
            $table->integer('capacity')->nullable();
            $table->string('booking_number')->nullable();
            $table->string('booking_email')->nullable();
            $table->string('category_slug')->nullable();
            $table->string('category')->nullable();
            $table->string('country_slug')->nullable();
            $table->string('country')->nullable();
            $table->text('amenities')->nullable();
            $table->string('profile_image')->nullable();
            $table->string('banner_image')->nullable();
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
        Schema::dropIfExists('venues');
    }
}
