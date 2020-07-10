<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatedInstrumentImages extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('instrument_images', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->integer('instrument_id')->comment('仪器ID');
            $table->string('path')->comment('仪器图片路径');
            $table->timestamps();
        });
        DB::statement(" ALTER TABLE instrument_images comment '仪器图片表' ");
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('instrument_images');
    }
}
