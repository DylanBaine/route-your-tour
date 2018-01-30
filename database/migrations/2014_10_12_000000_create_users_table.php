<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->increments('id');
            $table->boolean('newsletter')->default(1);
            $table->boolean('email_verified')->default(0);
            $table->integer('premium_level')->default(0);
            $table->string('name');
            $table->string('email')->unique();
            $table->string('email_confirmed_token')->nullable();
            $table->string('password');
            $table->string('avatar')->default('Defaults/default.png');
            $table->string('theme')->default('light');
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
        Schema::dropIfExists('users');
    }
}
