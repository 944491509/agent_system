<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateNetworkFaultsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('network_faults', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('area_stand_id')->comment('项目部id');
            $table->integer('source_id')->comment('故障来源id')->nullable();
            $table->integer('nature_id')->comment('故障性质id');
            $table->integer('time_id')->comment('时限id')->nullable();
            $table->tinyInteger('kind')->comment('故障种类')->nullable();
            $table->tinyInteger('type')->default(1)->comment('类型 1:网络故障 2:动环故障');
            $table->integer('station_id')->comment('基站id')->nullable();
            $table->dateTime('happen_time')->comment('发生时间');
            $table->dateTime('accept_time')->comment('接单时间')->nullable();
            $table->text('business')->comment('故障业务')->nullable();
            $table->text('message')->comment('故障信息')->nullable();
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
        Schema::dropIfExists('network_faults');
    }
}
