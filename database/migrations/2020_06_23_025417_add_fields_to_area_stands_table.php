<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddFieldsToAreaStandsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('area_stands', function (Blueprint $table) {
            //
            $table->integer('province_id')->comment('省份')->nullable();
            $table->tinyInteger('level')->default(1)->comment('级别');
            $table->text('type')->comment('业务类别')->nullable();
            $table->integer('area_id')->default(0)->comment('区域id');
            $table->text('operator')->comment('运营商')->nullable()->change();
            $table->text('explain')->comment('说明')->nullable()->change();

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('area_stands', function (Blueprint $table) {
            //
            $table->dropColumn('province_id');
            $table->dropColumn('operator');
            $table->dropColumn('explain');
            $table->dropColumn('level');
            $table->dropColumn('type');
            $table->dropColumn('area_id');

        });
        Schema::table('area_stands', function (Blueprint $table) {
            $table->integer('operator')->nullable()->comment('运营商');
            $table->integer('explain')->nullable()->comment('说明');
        });
    }
}
