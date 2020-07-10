<?php

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTaskGroupsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('task_groups', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('stand_id')->comment('项目部ID');
            $table->integer('department_id')->comment('部门ID');
            $table->string('name',30)->comment('班组名称');
            $table->timestamps();
        });
        DB::statement(" ALTER TABLE task_groups comment '班组表' ");

        Schema::table('departments', function (Blueprint $table) {
            $table->dropColumn('group');
        });

        $id = DB::table('admin_menu')->where('title', '区站基础资料')->value('id');
        $data = [
            [
                'parent_id' => $id,
                'order' => 5,
                'title' => '班组管理',
                'icon' => 'fa-group',
                'uri' => 'district/task-groups',
                'created_at' => \Carbon\Carbon::now()->toDateTimeString(),
                'updated_at' => \Carbon\Carbon::now()->toDateTimeString(),
            ],
        ];
        DB::table('admin_menu')->insert($data);
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('task_groups');
        Schema::table('departments', function (Blueprint $table) {
            $table->string('group')->comment('班组管理');
        });
        DB::table('admin_menu')->where('title', '班组管理')->delete();
    }
}
