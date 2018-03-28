<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTablePetaMateri extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('peta_materi', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('category_id')->nullable();
            $table->string('title')->nullable();
            $table->text('desc')->nullable();
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
        Schema::dropIfExists('peta_materi');
    }
}
