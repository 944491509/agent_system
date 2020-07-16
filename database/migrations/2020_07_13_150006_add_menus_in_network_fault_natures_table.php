<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddMenusInNetworkFaultNaturesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        $id = DB::table('admin_menu')->where('title', '故障管理')->value('id');
        $data = [
            [
                'parent_id' => $id,
                'order' => 1,
                'title' => '故障性质',
                'icon' => 'fa-code-fork',
                'uri' => 'fault/nature',
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
        $title = ['故障性质'];
        DB::table('admin_menu')->whereIn('title',$title)->delete();
    }
}
