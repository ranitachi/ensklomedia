<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSaungsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('saungs', function (Blueprint $table) {
            $table->increments('id');
            $table->string('saung_name')->nullable();
            $table->integer('video_id')->nullable();
            $table->integer('created_user_id')->nullable();
            $table->integer('fasilitasi_id')->default(0);
            $table->integer('reviewer_id')->default(0);
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
        Schema::dropIfExists('saungs');
    }
}
