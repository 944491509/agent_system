<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatedTroubles extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('troubles', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->integer('area_stand_id')->comment('项目部');
            $table->integer('network_type')->comment('网络类型');
            $table->integer('category')->comment('网络专业类别');
            $table->integer('network_name')->comment('网络专业名称');
            $table->string('name')->comment('业务名称');
            $table->string('position')->nullable()->comment('隐患地点');
            $table->string('distance')->nullable()->comment('距离');
            $table->string('reason')->nullable()->comment('隐患原因');
            $table->string('unit')->nullable()->comment('施工单位');
            $table->string('person')->nullable()->comment('施工联系人');
            $table->string('mobile')->nullable()->comment('施工单位电话');
            $table->tinyInteger('influence')->nullable()->comment('隐患影响等级');
            $table->tinyInteger('deal_with')->nullable()->comment('隐患处理等级');
            $table->tinyInteger('suggest')->nullable()->comment('建议处理方式');
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
        Schema::dropIfExists('troubles');
    }
}
