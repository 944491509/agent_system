<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatedUserProfilesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('user_profiles', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->integer('user_id')->comment('用户ID');
            $table->string('number', 50)->nullable()->comment('工号');
            $table->integer('education')->nullable()->comment('学历');
            $table->string('address', 100)->nullable()->comment('家庭住址');
            $table->string('id_number', 100)->comment('身份证号');
            $table->date('birthday')->nullable()->comment('生日');
            $table->integer('area_stand_id')->comment('项目部ID');
            $table->integer('department_id')->comment('部门ID');
            $table->integer('group_id')->comment('班组ID');
            $table->integer('post_id')->comment('岗位ID');
            $table->integer('major_id')->comment('专业ID');
            $table->date('entry_time')->comment('入职日期');
            $table->date('signing_time')->nullable()->comment('签约日期');
            $table->date('departure_time')->nullable()->comment('离职日期');
            $table->date('due_time')->nullable()->comment('合同到期日期');
            $table->string('serial')->nullable()->comment('合同编号');
            $table->tinyInteger('certificate')->default(0)->nullable()->comment('代维资格证书 0无 1有');
            $table->tinyInteger('accommodation')->default(0)->nullable()->comment('是否住宿 0否 1是');
            $table->string('dormitory_num', 100)->nullable()->comment('宿舍号');
            $table->string('card_num', 50)->nullable()->comment('劳保卡编号');
            $table->string('card_time')->nullable()->comment('劳保卡办理日期');
            $table->tinyInteger('is_insurance')->default(0)->nullable()->comment('意外保险是否缴纳 0否 1是');
            $table->string('insurance_company', 100)->nullable()->comment('保险公司');
            $table->date('insurance_time')->nullable()->comment('意外保险到期时间');
            $table->string('pay_card', 100)->nullable()->comment('工资卡编号');
            $table->tinyInteger('vehicle_card')->nullable()->default(0)->comment('是否有车辆行驶证 0无 1有');
            $table->date('get_vehicle_card_time')->nullable()->comment('车辆行驶证初领时间');
            $table->string('vehicle_model', 50)->nullable()->comment('准假车型');
            $table->string('vehicle_card_num', 50)->nullable()->comment('驾照编号');
            $table->date('vehicle_card_audit_time')->nullable()->comment('驾照年审时间');
            $table->date('next_vehicle_card_audit_time')->nullable()->comment('下次驾照年审时间');
            $table->date('id_card_time')->nullable()->comment('提交身证时间');
            $table->tinyInteger('status')->nullable()->default(1)->comment('是否在职 0否 1是');
            $table->string('note')->nullable()->comment('备注');
            $table->timestamps();
        });
        DB::statement(" ALTER TABLE user_profiles comment '用户信息表' ");
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('user_profiles');
    }
}
