<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTableRevisiMappingVideo extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('revisi', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('video_id')->nullable();
            $table->integer('mapping_id')->nullable();
            $table->string('keterangan')->nullable();
            $table->integer('reviewer_id')->nullable();
            $table->integer('flag_tanggap')->default(1);
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
        Schema::dropIfExists('revisi');
    }
}
