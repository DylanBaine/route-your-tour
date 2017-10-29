<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateBandRouteTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('band_route', function (Blueprint $table) {
            $table->integer('band_id')->unsigned();
            $table->integer('route_id')->unsigned();
            $table->timestamps();

            $table->primary(['route_id', 'band_id']);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('band_route');
    }
}
