<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTableMappingVideo extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('mapping_video', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('video_id')->nullable();
            $table->integer('user_id')->nullable();
            $table->string('nama')->nullable();
            $table->datetime('mapping_date')->nullable();
            $table->integer('flag_active')->default(1);
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
        Schema::dropIfExists('mapping_video');
    }
}
