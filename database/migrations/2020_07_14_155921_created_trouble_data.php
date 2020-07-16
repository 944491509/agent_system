<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatedTroubleData extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('trouble_datas', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->integer('p_id')->comment('父级ID');
            $table->string('name')->comment('名称');
            $table->timestamps();
        });
        DB::statement(" ALTER TABLE trouble_datas comment '网络隐患基础数据表' ");
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('trouble_datas');
    }
}
