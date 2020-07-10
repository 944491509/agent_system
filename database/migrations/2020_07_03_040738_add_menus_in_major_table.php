<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddMenusInMajorTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        $id = DB::table('admin_menu')->where('title', '区站基础资料')->value('id');
        $data = [
            [
                'parent_id' => $id,
                'order' => 2,
                'title' => '专业管理',
                'icon' => 'fa-bookmark-o',
                'uri' => 'district/majors',
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
        DB::table('admin_menu')->where('title', '专业管理')->delete();
    }
}
