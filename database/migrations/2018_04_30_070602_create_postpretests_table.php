<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePostpretestsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('postpretests', function (Blueprint $table) {
            $table->increments('id');
            $table->text('question')->nullable();
            $table->text('essay')->nullable();
            $table->integer('flag_pretest')->nullable()->default(1);
            $table->integer('flag_posttest')->nullable()->default(1);
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
        Schema::dropIfExists('postpretests');
    }
}
