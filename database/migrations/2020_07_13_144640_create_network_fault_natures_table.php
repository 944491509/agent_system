<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateNetworkFaultNaturesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('network_fault_natures', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('area_stand_id')->comment('项目部ID');
            $table->tinyInteger('type')->default(1)->comment('故障类型 1:网络故障 2:动环故障');
            $table->integer('source_id')->comment('故障来源id')->nullable();
            $table->string('name')->comment('名称');
            $table->timestamps();
        });
        DB::statement(" ALTER TABLE network_fault_natures comment '网络故障性质' ");

        Schema::create('network_fault_times', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('nature_id')->comment('故障性质id');
            $table->tinyInteger('hour')->comment('小时');
            $table->timestamps();
        });
        DB::statement(" ALTER TABLE network_fault_times comment '网络故障时限' ");
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('network_fault_natures');
        Schema::dropIfExists('network_fault_times');
    }
}
