<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddMenusInNetworkFaultSourcesTable extends Migration
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
            'order' => 3,
            'title' => '故障管理',
            'icon' => 'fa-exclamation-triangle',
            'created_at' => \Carbon\Carbon::now()->toDateTimeString(),
            'updated_at' => \Carbon\Carbon::now()->toDateTimeString(),
        ];
        $id = DB::table('admin_menu')->insertGetId($menu);
        $data = [
            'parent_id' => $id,
            'order' => 0,
            'title' => '故障来源',
            'icon' => 'fa-soundcloud',
            'uri' => 'fault/source',
            'created_at' => \Carbon\Carbon::now()->toDateTimeString(),
            'updated_at' => \Carbon\Carbon::now()->toDateTimeString(),
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
        $title = ['故障管理','故障来源'];
        DB::table('admin_menu')->whereIn('title',$title)->delete();
    }
}
