<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTopikturunansTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('topikturunans', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('video_id')->nullable();
            $table->integer('user_created_id')->nullable();
            $table->integer('saung_id')->nullable();
            $table->string('topik')->nullable();
            $table->text('penjelasan')->nullable();
            $table->integer('flag')->default(1);
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
        Schema::dropIfExists('topikturunans');
    }
}
