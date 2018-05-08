<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTablePenilaian extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
         Schema::create('penilaian', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('instrumen_id')->default(-1);
            $table->integer('reviewer_id')->default(-1);
            $table->integer('video_id')->default(-1);
            $table->integer('nilai')->default(-1);
            $table->integer('flag')->default(1);
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
        Schema::dropIfExists('penilaian');
    }
}
