<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateNetworkFaultSourcesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('network_fault_sources', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name',50)->comment('名称');
            $table->integer('area_stand_id')->comment('项目部ID');
            $table->timestamps();
        });
        DB::statement(" ALTER TABLE network_fault_sources comment '网络故障来源' ");
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('network_fault_sources');
    }
}
