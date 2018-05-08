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
            $table->string('email')->unique();
            $table->string('password');
            $table->string('registration_ip');
            $table->string('authentication_key');
            $table->string('authorization_level');
            $table->string('location')->nullable();
            $table->string('timezone')->nullable();
            $table->rememberToken();
            $table->datetime('activated_at')->nullable();
            $table->datetime('deactivated_at')->nullable();
            $table->datetime('blocked_at')->nullable();
            $table->integer('last_login_at')->nullable();
            $table->softdeletes();
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
