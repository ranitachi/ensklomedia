<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTableProfile extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        //
   Schema::create('profile', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('user_id');
            $table->string('name');
            $table->string('channel_name');
            $table->string('website')->nullable();
            $table->text('bio')->nullable();
            $table->string('gender')->nullable();
            $table->string('profession')->nullable();
            $table->string('province')->nullable();
            $table->string('district')->nullable();
            $table->string('address')->nullable();
            $table->string('phone_number')->nullable();
            $table->string('institute')->nullable();
            $table->string('educational_level')->nullable();
            $table->string('educational_level_detail')->nullable();
            $table->string('place_of_birth')->nullable();
            $table->date('date_of_birth')->nullable();
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
        Schema::dropIfExists('profile');
    }
}
