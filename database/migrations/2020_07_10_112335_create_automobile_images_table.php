<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAutomobileImagesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('automobile_images', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('automobile_id')->comment('汽车id');
            $table->string('path', 100)->comment('图片路径');
        });
        DB::statement(" ALTER TABLE automobile_images comment '车辆图片表' ");
        Schema::table('automobiles', function (Blueprint $table) {
            $table->decimal('rent')->comment('租金金额')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('automobile_images');
        Schema::table('automobile', function (Blueprint $table) {
            $table->dropColumn('rent');
        });
    }
}
