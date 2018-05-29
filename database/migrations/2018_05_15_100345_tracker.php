<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class Tracker extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tracker', function (Blueprint $table) {
            $table->increments('id');
            $table->string('ip')->nullable();
            $table->string('pages')->nullable();
            $table->date('date')->nullable();
            $table->time('visit_time')->nullable();
            $table->date('visit_date')->nullable();
            $table->integer('hits')->default(0);
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
        Schema::dropIfExists('tracker');
    }
}
