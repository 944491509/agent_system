<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatedUserMajorsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('user_majors', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->integer('user_id')->comment('用户ID');
            $table->integer('major_id_one')->nullable()->comment('专业技能1 ID');
            $table->integer('major_level_one')->nullable()->comment('专业级别1 ID');
            $table->integer('major_id_two')->nullable()->comment('专业技能2 ID');
            $table->integer('major_level_two')->nullable()->comment('专业技能级别2 ID');
            $table->integer('major_id_three')->nullable()->comment('专业技能3 ID');
            $table->integer('major_level_three')->nullable()->comment('专业技能级别3 ID');
            $table->integer('skill')->nullable()->comment('职业技能鉴定ID');
            $table->integer('skill_type')->nullable()->comment('职业技能鉴定类别ID');
            $table->integer('skill_level')->nullable()->comment('职业技能鉴定级别');
            $table->string('skill_num')->nullable()->comment('职业技能鉴定号');
            $table->date('skill_time')->nullable()->comment('职业技能鉴定时间');
            $table->timestamps();
        });

        DB::statement(" ALTER TABLE user_majors comment '用户技能表' ");
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('user_majors');
    }
}
