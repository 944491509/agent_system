<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddMenusInDepartment extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        // 维护部门管理二级菜单
        $id = DB::table('admin_menu')->where('title', '区站基础资料')->value('id');
        $data = [
            [
                'parent_id' => $id,
                'order' => 0,
                'title' => '维护部门管理',
                'icon' => 'fa-user',
                'uri' => 'district/departments',
                'created_at' => \Carbon\Carbon::now()->toDateTimeString(),
                'updated_at' => \Carbon\Carbon::now()->toDateTimeString(),
            ]
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
        DB::table('admin_menu')->where('title','维护部门管理')->delete();
    }
}