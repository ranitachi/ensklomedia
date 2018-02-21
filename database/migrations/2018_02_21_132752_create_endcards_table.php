<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateEndcardsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('endcards', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('video_id')->nullable();
            $table->string('title')->nullable();
            $table->text('link')->nullable();
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
        Schema::dropIfExists('endcards');
    }
}
