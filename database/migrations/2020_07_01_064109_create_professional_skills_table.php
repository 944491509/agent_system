<?php

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateProfessionalSkillsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        try {
            DB::beginTransaction();
            Schema::create('professional_skills', function (Blueprint $table) {
                $table->increments('id');
                $table->string('name',30)->comment('专业技能');
                $table->timestamps();
            });
            DB::statement(" ALTER TABLE professional_skills comment '专业技能表' ");

            Schema::create('professional_classes', function (Blueprint $table) {
                $table->increments('id');
                $table->integer('skill_id')->comment('技能ID');
                $table->string('name',30)->comment('专业等级');
                $table->timestamps();
            });
            DB::statement(" ALTER TABLE professional_class comment '专业等级表' ");
            DB::commit();
        } catch (Exception $e) {
            DB::rollBack();
        }


    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('professional_skills');
        Schema::dropIfExists('professional_classes');
    }
}
