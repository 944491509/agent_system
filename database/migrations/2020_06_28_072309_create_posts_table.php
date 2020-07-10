<?php

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePostsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('posts', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('stand_id')->comment('项目部ID');
            $table->integer('department_id')->comment('部门ID');
            $table->string('name', 30)->comment('岗位名称');
            $table->text('explain')->comment('岗位说明')->nullable();
            $table->text('require')->comment('岗位要求')->nullable();
            $table->tinyInteger('level')->default(1)->comment('岗位级别');
            $table->text('belong_to')->comment('岗位所属');
            $table->timestamps();
        });
        DB::statement(" ALTER TABLE posts comment '岗位表' ");
        $id = DB::table('admin_menu')->where('title', '区站基础资料')->value('id');
        $data = [
            [
                'parent_id' => $id,
                'order' => 4,
                'title' => '岗位管理',
                'icon' => 'fa-steam',
                'uri' => 'district/posts',
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
        Schema::dropIfExists('posts');
        DB::table('admin_menu')->where('title','岗位管理')->delete();
    }
}
