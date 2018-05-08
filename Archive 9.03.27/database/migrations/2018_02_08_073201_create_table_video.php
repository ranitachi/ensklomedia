<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTableVideo extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
       Schema::create('video', function (Blueprint $table) {
            $table->increments('id');
            $table->string('user_id');
            $table->string('category_id');
            $table->string('title')->nullable();
            $table->text('desc')->nullable();
            $table->string('video_path')->nullable();
            $table->string('image_path')->nullable();
            $table->string('tags')->nullable();
            $table->integer('hit')->nullable();
            $table->string('slug')->nullable();
            $table->integer('approved_by')->nullable();
            $table->datetime('approved_at')->nullable();
            $table->datetime('deactivated_at')->nullable();
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
        Schema::dropIfExists('video');
    }
}
