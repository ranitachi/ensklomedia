<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateEvaluasipesertasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('evaluasipesertas', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('user_id')->default(0);
            $table->integer('penyelenggara_id')->default(0);
            $table->integer('narasumber_id')->default(0);
            $table->string('nama_narasumber')->nullable();
            $table->string('materi_fasilitasi')->nullable();
            $table->string('jam_ke')->nullable();
            $table->string('jenis')->nullable();
            $table->string('pilihan')->nullable();
            $table->text('saran')->nullable();
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
        Schema::dropIfExists('evaluasipesertas');
    }
}
