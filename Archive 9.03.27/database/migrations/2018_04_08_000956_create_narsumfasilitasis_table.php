<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateNarsumfasilitasisTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('narsumfasilitasis', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('narsum_1_id')->nullable();
            $table->integer('narsum_2_id')->nullable();
            $table->integer('fasilitasi_id')->nullable();
            $table->integer('wilayah_id')->nullable();
            $table->date('start_date')->nullable();
            $table->date('end_date')->nullable();
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
        Schema::dropIfExists('narsumfasilitasis');
    }
}
