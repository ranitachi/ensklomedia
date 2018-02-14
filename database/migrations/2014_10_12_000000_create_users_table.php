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
            $table->string('name');
            $table->string('email')->unique();
            $table->string('unconfirmed_email')->nullable();
            $table->string('username');
            $table->string('password_hash');
            $table->string('password');
            $table->string('auth_key');
            $table->string('registration_ip');
            $table->integer('confirmed_at')->nullable();
            $table->integer('blocked_at')->nullable();
            $table->integer('flags')->default(0);
            $table->integer('last_login_at')->nullable;
            $table->string('hakakses');
            $table->string('status');
            $table->rememberToken();
            $table->timestamps();
            $table->softdeletes();
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
