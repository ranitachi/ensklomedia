<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTableProfile extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        //
   Schema::create('profile', function (Blueprint $table) {
            $table->increments('user_id');
            $table->string('name');
            $table->string('public_email')->nullable();
            $table->string('gravatar_email')->nullable();
            $table->string('gravatar_id')->nullable();
            $table->string('location')->nullable();
            $table->string('website')->nullable();
            $table->text('bio')->nullable();
            $table->string('timezone')->nullable();
            $table->string('rekomendasi')->nullable();
            $table->string('nama')->nullable();
            $table->string('jk')->nullable();
            $table->string('profesi')->nullable();
            $table->string('provinsi')->nullable();
            $table->string('kabupaten')->nullable();
            $table->string('alamat1')->nullable();
            $table->string('hp')->nullable();
            $table->string('email')->unique();
            $table->string('instansi')->nullable();
            $table->string('jenjang')->nullable();
            $table->string('alamat')->nullable();
            $table->string('telp')->nullable();
            $table->string('pelatihan_id')->nullable();
            $table->string('tahun_id')->nullable();
            $table->string('tempatlahir')->nullable();
            $table->string('tgllahir')->nullable();
            $table->string('golnip')->nullable();
            $table->string('npwp')->nullable();
            $table->string('s1')->nullable();
            $table->string('s2')->nullable();
            $table->string('s3')->nullable();
            $table->string('slain')->nullable();
            $table->string('namakepsek')->nullable();
            $table->string('hpkepsek')->nullable();
            $table->string('emailkepsek')->nullable();
            $table->string('petugaspusat')->nullable();
            $table->integer('flags')->default(1);
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
        Schema::dropIfExists('profile');
    }
}
