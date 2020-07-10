<?php

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateFacilitatorMenusTable extends Migration
{

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        // 添加一级菜单
        $menu = [
            'parent_id' => 0,
            'order' => 0,
            'title' => '区站基础资料',
            'icon' => 'fa-bars',
            'created_at' => \Carbon\Carbon::now()->toDateTimeString(),
            'updated_at' => \Carbon\Carbon::now()->toDateTimeString(),
        ];
        $id = DB::table('admin_menu')->insertGetId($menu);

        $data = [
            [
                'parent_id' => $id,
                'order' => 1,
                'title' => '项目部管理',
                'icon' => 'fa-bars',
                'uri' => 'district/area-stands',
                'created_at' => \Carbon\Carbon::now()->toDateTimeString(),
                'updated_at' => \Carbon\Carbon::now()->toDateTimeString(),
            ],
            [
                'parent_id' => $id,
                'order' => 0,
                'title' => '服务商',
                'icon' => 'fa-jsfiddle',
                'uri' => 'district/facilitators',
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
        $title = ['区站基础资料','区站列表', '服务商'];
        DB::table('admin_menu')->whereIn('title',$title)->delete();
    }
}
