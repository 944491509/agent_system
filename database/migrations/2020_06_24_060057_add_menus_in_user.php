<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddMenusInUser extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        // 人员管理二级菜单
        $id = DB::table('admin_menu')->where('title', '区站基础资料')->value('id');
        $data = [
            [
                'parent_id' => $id,
                'order' => 2,
                'title' => '人员管理',
                'icon' => 'fa-user',
                'uri' => 'district/users',
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
        DB::table('admin_menu')->where('title','人员管理')->delete();
    }
}
