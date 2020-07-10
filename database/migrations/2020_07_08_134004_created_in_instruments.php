<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatedInInstruments extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('instruments', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->integer('area_stand_id')->comment('项目部ID');
            $table->string('name', 100)->comment('仪器名称');
            $table->string('model', 100)->nullable()->comment('仪器型号');
            $table->integer('number')->default(1)->comment('仪器数量');
            $table->string('unit')->nullable()->comment('维护仪器单位');
            $table->string('factory')->nullable()->comment('生产厂家');
            $table->timestamps();
        });
        DB::statement(" ALTER TABLE instruments comment '仪器表' ");
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('instruments');
    }
}
