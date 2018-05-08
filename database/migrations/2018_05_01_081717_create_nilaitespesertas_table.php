<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateNilaitespesertasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('nilaitespesertas', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('user_id')->default(0);
            $table->double('nilai')->default(0);
            $table->string('jenis')->nullable();
            $table->integer('fasilitasi_id')->default(0);
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
        Schema::dropIfExists('nilaitespesertas');
    }
}
