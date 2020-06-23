<?php

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateFacilitatorsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('facilitators', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name')->comment('服务商');
            $table->tinyInteger('status')->default(1)->comment('状态 0:隐藏 1:展示');
            $table->timestamps();
        });
        DB::statement(" ALTER TABLE facilitators comment '服务商表' ");

    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('facilitators');
    }
}
