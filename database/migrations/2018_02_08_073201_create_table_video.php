<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTableVideo extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
       Schema::create('video', function (Blueprint $table) {
            $table->increments('id');
            $table->string('userid');
            $table->string('videofile')->nullable();
            $table->string('filetype')->nullable();
            $table->string('title')->nullable();
            $table->text('description')->nullable();
            $table->string('tags')->nullable();
            $table->string('image')->nullable();
            $table->text('turunan1')->nullable();
            $table->text('turunan2')->nullable();
            $table->text('turunan3')->nullable();
            $table->text('turunan4')->nullable();
            $table->text('turunan5')->nullable();
            $table->text('catatan')->nullable();
            $table->string('registrationip')->nullable();
            $table->string('approvedby')->nullable();
            $table->string('approvedat')->nullable();
            $table->integer('statusaktif')->default(0);
            $table->string('hit')->nullable();
            $table->string('createdat')->nullable();
            $table->string('slug')->nullable();
            $table->string('category_id')->nullable();
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
        Schema::dropIfExists('video');
    }
}
