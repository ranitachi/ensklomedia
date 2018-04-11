<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePesertatantangansTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('peserta_tantangan', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('video_id')->nullable();
            $table->integer('user_id')->nullable();
            $table->integer('saung_id')->nullable();
            $table->integer('tantangan_id')->nullable();
            $table->string('judul')->nullable();
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
        Schema::dropIfExists('peserta_tantangan');
    }
}
