<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddFlagActiveVideo extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('video', function (Blueprint $table) {
            $table->integer('deactivated_by')->after('deactivated_at')->nullable();
            $table->integer('active_by')->after('deactivated_by')->nullable();
            $table->datetime('flag_active')->default(0)->after('active_by')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('video', function (Blueprint $table) {
            //
        });
    }
}
