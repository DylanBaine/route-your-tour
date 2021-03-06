<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateBandsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('bands', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name');
            $table->integer('times_visited')->default(0);
            $table->string('slug')->unique();
            $table->string('location');
            $table->string('soundcloud_url')->nullable();
            $table->text('bio')->nullable();
            $table->integer('number_of_routes_booked')->default(0);
            $table->string('primary_genre')->nullable();
            $table->string('sub_genre')->nullable();
            $table->string('banner')->nullable();
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
        Schema::dropIfExists('bands');
    }
}
