<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;

class CreateAreaStandsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('area_stands', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('city_id')->default(0)->comment('城市')->nullable();
            $table->integer('district_id')->default(0)->comment('区县')->nullable();
            $table->string('name', 50)->comment('区站名称');
            $table->tinyInteger('operator')->default(1)->comment('运营商 1:联通 2:移动 3:电信');
            $table->tinyInteger('explain')->comment('说明');
            $table->text('remark');
            $table->timestamps();
        });
        DB::statement(" ALTER TABLE area_stands comment '区站管理表' ");

    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('area_stands');
    }
}
