<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatedDepartmentTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('departments', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('area_stand_id')->comment('区站ID');
            $table->string('name')->comment('部门名称');
            $table->string('group')->comment('部门班组');
            $table->tinyInteger('rank')->comment('部门级别');
            $table->timestamps();
        });

        DB::statement(" ALTER TABLE departments comment '部门表' ");
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('departments');
    }
}
