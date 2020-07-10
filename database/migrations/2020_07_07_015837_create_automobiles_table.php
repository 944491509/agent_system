<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAutomobilesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('automobiles', function (Blueprint $table) {
            $table->increments('id');
            $table->string('number',30)->comment('车牌号码');
            $table->text('explain')->comment('车辆说明')->nullable();
            $table->tinyInteger('type')->comment('车辆类型');
            $table->string('manufacturers',100)->comment('车辆厂家')->nullable();
            $table->string('model',100)->comment('车辆型号')->nullable();
            $table->string('displacement',50)->comment('车辆排量')->nullable();
            $table->string('bought_company', 100)->comment('购入单位')->nullable();
            $table->string('car_owner',20)->comment('车主')->nullable();
            $table->decimal('price')->comment('购买价格');
            $table->string('oil_wear',30)->comment('日常油耗')->nullable();
            $table->string('engine_num', 100)->comment('发动机号')->nullable();
            $table->string('vin', 100)->comment('车架号')->nullable();
            $table->string('loads', 20)->comment('载重')->nullable();
            $table->integer('stand_id')->comment('项目部ID');
            $table->integer('user_id')->comment('驾驶员');
            $table->tinyInteger('nature')->comment('车辆性质 1:自有 2:租赁');
            $table->tinyInteger('use')->comment('车辆用途 1:维护 2:工程 3:发电');
            $table->date('bought_at')->comment('购入时间');
            $table->timestamps();
        });
        DB::statement(" ALTER TABLE automobiles comment '车辆表' ");

        $id = DB::table('admin_menu')->where('title', '区站基础资料')->value('id');
        $data = [
            [
                'parent_id' => $id,
                'order' => 7,
                'title' => '车辆管理',
                'icon' => 'fa-car',
                'uri' => 'district/automobiles',
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
        Schema::dropIfExists('automobiles');
        DB::table('admin_menu')->where('title', '车辆管理')->delete();
    }
}
